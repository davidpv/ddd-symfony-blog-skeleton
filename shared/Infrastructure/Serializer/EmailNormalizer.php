<?php declare(strict_types=1);

namespace Shared\Infrastructure\Serializer;

use Shared\Domain\ValueObject\EmailValueObject;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class EmailNormalizer implements ContextAwareNormalizerInterface
{

    public function __construct(private ObjectNormalizer $normalizer)
    {
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof EmailValueObject;
    }

    /**
     * @param EmailValueObject $object
     * @param string|null $format
     * @param array $context
     * @return mixed
     */
    public function normalize(mixed $object, string $format = null, array $context = [])
    {
        return $object->getFullAddress();
    }
}