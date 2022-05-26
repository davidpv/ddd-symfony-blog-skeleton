<?php

namespace Shared\Domain\ValueObject;

interface ValueObject
{

    public function getValue();

    public function isTheSameAs($object): bool;
}