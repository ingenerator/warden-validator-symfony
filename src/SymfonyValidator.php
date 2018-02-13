<?php
namespace Ingenerator\Warden\Validator\Symfony;

use Ingenerator\Warden\Core\Validator\Validator;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author    Andrew Coulton <andrew@ingenerator.com>
 * @licence   proprietary
 */
class SymfonyValidator implements Validator
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate($object)
    {
        $errors         = $this->validator->validate($object);
        $error_messages = [];
        foreach ($errors as $error) {
            /** @var ConstraintViolationInterface $error */
            $error_messages[$error->getPropertyPath()] = $error->getMessage();
        }

        return $error_messages;
    }
}
