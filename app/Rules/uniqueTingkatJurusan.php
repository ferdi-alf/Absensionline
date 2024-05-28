<?php

namespace App\Rules;

use Closure;
use App\Models\Kelas;
use Illuminate\Contracts\Validation\ValidationRule;

class uniqueTingkatJurusan implements ValidationRule
{

    private $tingkat;
    private $jurusan;

    public function __construct($tingkat, $jurusan)
    {
        $this->tingkat = $tingkat;
        $this->jurusan = $jurusan;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (Kelas::where('tingkat', $this->tingkat)->where('jurusan', $this->jurusan)->exists()) {
            $fail('tingkat dan jurusan yang di masukan sudah ada.');
        }
    }
}
