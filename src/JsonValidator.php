<?php

declare(strict_types=1);

namespace Codelicia\XulietaJson;

use Codelicia\Xulieta\Validator\Validator;
use Codelicia\Xulieta\ValueObject\SampleCode;
use Codelicia\Xulieta\ValueObject\Violation;
use LogicException;
use Throwable;

use function json_decode;

use const JSON_THROW_ON_ERROR;

final class JsonValidator implements Validator
{
    public function supports(SampleCode $sampleCode): bool
    {
        return $sampleCode->language() === 'json';
    }

    public function hasViolation(SampleCode $sampleCode): bool
    {
        try {
            json_decode($sampleCode->code(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            return true;
        }

        return false;
    }

    public function getViolation(SampleCode $sampleCode): Violation
    {
        try {
            json_decode($sampleCode->code(), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $ex) {
            return new Violation($sampleCode, $ex->getMessage(), 0);
        }

        throw new LogicException();
    }
}
