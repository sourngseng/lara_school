<?php

namespace App\Faker\Providers;

use Faker\Provider\Base;

class KhmerNameProvider extends Base
{
    protected static $firstNames = [
        'សុខ', 'ស៊ង់', 'មនោរម្យ', 'កនិកា', 'មុនី', 'សុវណ្ណ', 'សុខា', 'កុសល', 'សុភ័ក្ត្រ', 'ចំរើន',
        'សុចិត្រ', 'សោភា', 'សាវ៉ាត', 'អង្គារសិល', 'ស៊ុន', 'សុភា', 'សុខេន', 'សារឿន', 'សារី', 'សំណាង'
    ];

    protected static $lastNames = [
        'ឈិន', 'សារ៉េត', 'សុខ', 'សេង', 'លាប', 'ស៊ីន', 'កែវ', 'យូសុប', 'វ៉ាន់', 'ពិសី',
        'សុខុម', 'ឈឿង', 'សុជាតិ', 'ចាន់ស៊ា', 'សុវណ្ណ', 'សាវឿន', 'ពេជ្រ', 'សោភា', 'វណ្ណៈ', 'ឃឿន'
    ];

    public function khmerFirstName()
    {
        return static::randomElement(static::$firstNames);
    }

    public function khmerLastName()
    {
        return static::randomElement(static::$lastNames);
    }

    public function khmerName()
    {
        return $this->khmerFirstName() . ' ' . $this->khmerLastName();
    }
}