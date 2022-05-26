<?php declare(strict_types=1);

namespace Shared\Infrastructure\Serializer;

use Shared\Domain\ValueObject\UuidValueObject;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class UuidNormalizer implements ContextAwareNormalizerInterface
{

    public function __construct(private ObjectNormalizer $normalizer)
    {
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof UuidValueObject;
    }

    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        return $object->getValue();
    }
}