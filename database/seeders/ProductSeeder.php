<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Paracetamol 500mg',
                'description' => 'For fever and mild pain relief',
                'price' => 5.99,
                'stock_quantity' => 250,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Ibuprofen 200mg',
                'description' => 'For fever, inflammation, and pain relief',
                'price' => 7.50,
                'stock_quantity' => 180,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Amoxicillin 250mg',
                'description' => 'Antibiotic for bacterial infections causing sore throat',
                'price' => 12.75,
                'stock_quantity' => 90,
                'expiry_date' => Carbon::now()->addYear()->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Dextromethorphan Syrup',
                'description' => 'For dry cough relief',
                'price' => 8.25,
                'stock_quantity' => 120,
                'expiry_date' => Carbon::now()->addMonths(18)->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Loratadine 10mg',
                'description' => 'For allergies and skin rash relief',
                'price' => 6.40,
                'stock_quantity' => 200,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Salbutamol Inhaler',
                'description' => 'For cough and breathing difficulties in asthma',
                'price' => 15.99,
                'stock_quantity' => 75,
                'expiry_date' => Carbon::now()->addMonths(10)->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Cetirizine 10mg',
                'description' => 'For skin rash and allergy symptoms',
                'price' => 4.99,
                'stock_quantity' => 150,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Hydrocortisone Cream 1%',
                'description' => 'For skin rash and irritation relief',
                'price' => 6.25,
                'stock_quantity' => 60,
                'expiry_date' => Carbon::now()->addMonths(15)->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Guaifenesin Syrup',
                'description' => 'For productive cough and chest congestion',
                'price' => 7.80,
                'stock_quantity' => 95,
                'expiry_date' => Carbon::now()->addYear()->format('Y-m-d'),
                'status' => 'active'
            ],
            [
                'name' => 'Chlorpheniramine Maleate',
                'description' => 'For cough, cold, and allergy symptoms',
                'price' => 5.20,
                'stock_quantity' => 130,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}