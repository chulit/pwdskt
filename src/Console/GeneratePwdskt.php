<?php

namespace Diskominfotik\Pwdskt\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GeneratePwdskt extends Command
{
    protected $signature = 'pwdskt:generate {password}';
    protected $description = 'Generate password sakti';

    public function handle()
    {
        $this->info('Generate password...');
        $password = $this->argument('password');
        $hash = Hash::make($password);
        if ($this->setEnvironmentValue(['PWD_SKT' => $hash])) {
            $this->info('Password generated');
        } else {
            $this->error('Failed to generate password');
        }
    }

    protected function setEnvironmentValue(array $values)
    {

        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $str .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (!$keyPosition || !$endOfLinePosition || !$oldLine) {
                    $str .= "{$envKey}={$envValue}\n";
                } else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) return false;
        return true;
    }
}
