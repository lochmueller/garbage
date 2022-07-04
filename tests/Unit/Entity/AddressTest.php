<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Address;
use App\Tests\Unit\AbstractUnitTest;
use Symfony\Component\Validator\Validation;

class AddressTest extends AbstractUnitTest
{
    /**
     * @dataProvider getValidAddressProvider
     */
    public function testValidAddresses(Address $address)
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        self::assertEquals(0, $validator->validate($address)->count());
    }

    /**
     * @dataProvider getInvalidAddressProvider
     */
    public function testInvalidAddresses(Address $address)
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();
        self::assertGreaterThan(0, $validator->validate($address)->count());
    }

    public function getValidAddressProvider(): \Generator
    {
        yield [new Address('Schürhornweg', '16', '33649', 'Bielefeld', 'DE')];
        yield [new Address('Palmstraße', '27', '50672', 'Köln', 'DE')];
    }

    public function getInvalidAddressProvider(): \Generator
    {
        yield [new Address('Schürhornweg', '', '33649', 'Bielefeld', 'DE')];
        yield [new Address('Schürhornweg', '2', '33649', 'Bielefeld', 'Deutschland')];
        yield [new Address('Schürhornweg', '2', '', 'Bielefeld', 'DE')];
    }
}
