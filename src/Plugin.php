<?php

declare(strict_types=1);

namespace Codelicia\XulietaJson;

// @TODO rename
use Codelicia\Xulieta\Plugin\Plugin as ICodeliciaPlugin;
use Codelicia\Xulieta\Output\OutputFormatter;
use Codelicia\Xulieta\External\Markinho;
use Codelicia\Xulieta\ValueObject\Violation;
use Symfony\Component\Finder\SplFileInfo;

final class Plugin implements ICodeliciaPlugin
{
    /** @psalm-return list<non-empty-string> */
    public function supportedExtensions(): array
    {
        return ['md', 'rst'];
    }

    public function canHandle(SplFileInfo $file): bool
    {
        return true;
    }

    public function __invoke(SplFileInfo $file, OutputFormatter $output): bool
    {
        foreach (Markinho::extractCodeBlocks($file->getPathname(), $file->getContents()) as $codeBlock) {
            if ($codeBlock->language() !== 'json') {
                continue;
            }

            try {
                json_decode($codeBlock->code(), true, 512, JSON_THROW_ON_ERROR);
            } catch (\Exception $ex) {
                $output->addViolation(new Violation($codeBlock, $ex->getMessage(), 0));

                return false;
            }
        }
    }
}
