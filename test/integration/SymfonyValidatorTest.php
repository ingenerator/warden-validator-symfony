<?php
/**
 * @author    Andrew Coulton <andrew@ingenerator.com>
 * @licence   proprietary
 */

namespace test\integration\Ingenerator\Warden\Validator\Symfony;


use Ingenerator\Warden\Validator\Symfony\SymfonyValidator;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Yaml\Yaml;

class SymfonyValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    protected static $yaml_mapping_file;

    public function test_it_is_initialisable()
    {
        $subject = $this->newSubject();
        $this->assertInstanceOf(SymfonyValidator::class, $subject);
        $this->assertInstanceOf(\Ingenerator\Warden\Core\Validator\Validator::class, $subject);
    }

    public function test_it_returns_empty_array_for_valid_object()
    {
        $this->assertSame([], $this->newSubject()->validate(new TestParentData('Andrew', 'Oscar')));
    }

    public function test_it_returns_array_of_errors_by_property_for_invalid_object()
    {
        $this->assertEquals(
            [
                'child.name' => 'This value should not be blank.',
                'name'       => 'This value should not be blank.',

            ],
            $this->newSubject()->validate(new TestParentData('', ''))
        );
    }

    protected function newSubject()
    {
        $builder = Validation::createValidatorBuilder();
        $builder->addYamlMapping(static::$yaml_mapping_file);

        return new SymfonyValidator($builder->getValidator());
    }

    public static function setUpBeforeClass()
    {
        static::$yaml_mapping_file = sys_get_temp_dir().'/test-mapping.yaml';
        file_put_contents(
            static::$yaml_mapping_file,
            Yaml::dump(
                [
                    TestParentData::class => [
                        'properties' => [
                            'child' => [['Valid' => NULL]],
                            'name'  => [['NotBlank' => NULL]],
                        ],
                    ],
                    TestChildData::class  => [
                        'properties' => [
                            'name' => [['NotBlank' => NULL]],
                        ],
                    ],
                ]
            )
        );
    }

    public static function teardownAfterClass()
    {
        unlink(static::$yaml_mapping_file);
    }

}

class TestParentData
{

    /**
     * @var TestChildData
     */
    protected $child;

    protected $name;

    public function __construct($name, $child_name)
    {
        $this->name  = $name;
        $this->child = new TestChildData($child_name);
    }

}

class TestChildData
{
    protected $name;

    public function __construct($name) { $this->name = $name; }

}
