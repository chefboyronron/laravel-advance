<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Company;

class AddCompanyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'contact:company';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new company';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $name = $this->ask('What is the company\'s name?');
        $phone = $this->ask('What is the company\'s phone number?');

        $this->info($name);
        $this->info($phone);

        if( $this->confirm('Are you sure you want to add "' . $name . '"?') ) {
            $company = Company::create([
                'name' => $this->argument('name'),
                'phone' => $this->argument('phone') ?? 'N/A'
            ]);

            $this->info('Added:' . $company->name);
        } else {
            $this->warn('No company was added.');
        }


        // $this->info('info string'); // Green text in console
        // $this->warn('warning string'); // Yello text in console
        // $this->error('error string'); // Red text in console


    }
}
