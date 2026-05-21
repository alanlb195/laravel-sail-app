<?php

use App\Business\Services\EncryptService;

test('Prueba de encriptador, que encripte y sea distinto', function () {

    $key = 'unaclavesecreta123*[]';

    $encryptor = new EncryptService($key);

    $originalString = 'Una cadena de texto asd123';

    $encryptedString = $encryptor->encrypt($originalString);

    expect($encryptedString)->not->toBe($originalString);
});



test('Prueba que desencripte y sea igual ', function () {
    $key = 'unaclavesecreta123*[]';

    $key = 'unaclavesecreta123*[]';

    $encryptor = new EncryptService($key);

    $originalString = 'Una cadena de texto asd123';

    $encryptedString = $encryptor->encrypt($originalString);

    $decryptedString = $encryptor->decrypt($encryptedString);

    expect($decryptedString)->toBe($originalString);
});


test("Excepcion cuando la key sea distinta para desencriptar", function () {

    $key = 'unaclavesecreta123*[]';
    $key2 = 'unaclavesecreta123*[]1234';

    $encryptor1 = new EncryptService($key);
    $encryptor2 = new EncryptService($key2);

    $encryptedString = $encryptor1->encrypt("Prueba");

    $this->expectException(Exception::class);
    $encryptor2->decrypt($encryptedString);
});
