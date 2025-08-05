<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\PrescriptionItem;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class PharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create users with different roles
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@pharmacare.com',
            'role' => 'administrator',
            'is_active' => true,
        ]);

        User::factory()->create([
            'name' => 'Dr. Sarah Johnson',
            'email' => 'pharmacist@pharmacare.com',
            'role' => 'pharmacist',
            'is_active' => true,
        ]);

        User::factory()->create([
            'name' => 'Mike Wilson',
            'email' => 'cashier@pharmacare.com',
            'role' => 'cashier',
            'is_active' => true,
        ]);

        // Create sample drugs
        $drugs = [
            [
                'name' => 'Paracetamol 500mg',
                'generic_name' => 'Acetaminophen',
                'brand' => 'Tylenol',
                'category' => 'Pain Relief',
                'description' => 'Pain reliever and fever reducer',
                'price' => 12.99,
                'stock_quantity' => 150,
                'minimum_stock' => 20,
                'unit' => 'tablets',
                'expiry_date' => now()->addMonths(18),
                'batch_number' => 'BATCH-001234',
                'requires_prescription' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Amoxicillin 500mg',
                'generic_name' => 'Amoxicillin',
                'brand' => 'Amoxil',
                'category' => 'Antibiotics',
                'description' => 'Antibiotic for bacterial infections',
                'price' => 24.50,
                'stock_quantity' => 8, // Low stock
                'minimum_stock' => 15,
                'unit' => 'capsules',
                'expiry_date' => now()->addMonths(12),
                'batch_number' => 'BATCH-002345',
                'requires_prescription' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Lisinopril 10mg',
                'generic_name' => 'Lisinopril',
                'brand' => 'Prinivil',
                'category' => 'Blood Pressure',
                'description' => 'ACE inhibitor for high blood pressure',
                'price' => 35.75,
                'stock_quantity' => 75,
                'minimum_stock' => 10,
                'unit' => 'tablets',
                'expiry_date' => now()->addMonths(24),
                'batch_number' => 'BATCH-003456',
                'requires_prescription' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Metformin 850mg',
                'generic_name' => 'Metformin',
                'brand' => 'Glucophage',
                'category' => 'Diabetes',
                'description' => 'Medication for type 2 diabetes',
                'price' => 18.25,
                'stock_quantity' => 120,
                'minimum_stock' => 25,
                'unit' => 'tablets',
                'expiry_date' => now()->addMonths(20),
                'batch_number' => 'BATCH-004567',
                'requires_prescription' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Vitamin D3 1000IU',
                'generic_name' => 'Cholecalciferol',
                'brand' => 'Nature Made',
                'category' => 'Vitamins',
                'description' => 'Vitamin D supplement',
                'price' => 15.99,
                'stock_quantity' => 200,
                'minimum_stock' => 30,
                'unit' => 'capsules',
                'expiry_date' => now()->addMonths(36),
                'batch_number' => 'BATCH-005678',
                'requires_prescription' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Expired Aspirin 325mg',
                'generic_name' => 'Acetylsalicylic Acid',
                'brand' => 'Bayer',
                'category' => 'Pain Relief',
                'description' => 'Pain reliever and anti-inflammatory',
                'price' => 8.99,
                'stock_quantity' => 50,
                'minimum_stock' => 15,
                'unit' => 'tablets',
                'expiry_date' => now()->subMonths(2), // Expired
                'batch_number' => 'BATCH-006789',
                'requires_prescription' => false,
                'status' => 'active',
            ],
        ];

        foreach ($drugs as $drugData) {
            Drug::create($drugData);
        }

        // Create more sample drugs with factory
        Drug::factory(25)->create();
        Drug::factory(5)->lowStock()->create();
        Drug::factory(3)->expired()->create();

        // Create sample customers
        $customers = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@email.com',
                'phone' => '+1-555-0123',
                'address' => '123 Main St, Anytown, ST 12345',
                'date_of_birth' => '1985-05-15',
                'gender' => 'male',
                'medical_conditions' => 'Hypertension, Diabetes Type 2',
                'allergies' => 'Penicillin',
                'status' => 'active',
            ],
            [
                'name' => 'Mary Johnson',
                'email' => 'mary.johnson@email.com',
                'phone' => '+1-555-0124',
                'address' => '456 Oak Ave, Somewhere, ST 12346',
                'date_of_birth' => '1972-11-22',
                'gender' => 'female',
                'medical_conditions' => 'Arthritis',
                'allergies' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Robert Wilson',
                'email' => 'robert.wilson@email.com',
                'phone' => '+1-555-0125',
                'address' => '789 Pine Rd, Elsewhere, ST 12347',
                'date_of_birth' => '1990-03-08',
                'gender' => 'male',
                'medical_conditions' => null,
                'allergies' => 'Shellfish',
                'status' => 'active',
            ],
        ];

        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }

        // Create more customers with factory
        Customer::factory(20)->create();

        // Create sample prescriptions
        $customer1 = Customer::first();
        $customer2 = Customer::skip(1)->first();
        $amoxicillin = Drug::where('name', 'like', '%Amoxicillin%')->first();
        $lisinopril = Drug::where('name', 'like', '%Lisinopril%')->first();

        $prescription1 = Prescription::create([
            'prescription_number' => 'RX-' . str_pad('1', 6, '0', STR_PAD_LEFT),
            'customer_id' => $customer1->id,
            'doctor_name' => 'Dr. Emily Carter',
            'doctor_license' => 'MD12345',
            'prescription_date' => now()->subDays(2),
            'status' => 'pending',
            'notes' => 'Take with food',
        ]);

        PrescriptionItem::create([
            'prescription_id' => $prescription1->id,
            'drug_id' => $amoxicillin->id,
            'quantity_prescribed' => 21,
            'quantity_dispensed' => 0,
            'dosage_instructions' => 'Take 1 capsule three times daily with meals',
            'duration_days' => 7,
        ]);

        $prescription2 = Prescription::create([
            'prescription_number' => 'RX-' . str_pad('2', 6, '0', STR_PAD_LEFT),
            'customer_id' => $customer2->id,
            'doctor_name' => 'Dr. Michael Brown',
            'doctor_license' => 'MD67890',
            'prescription_date' => now()->subDays(1),
            'status' => 'pending',
            'notes' => 'Monitor blood pressure regularly',
        ]);

        PrescriptionItem::create([
            'prescription_id' => $prescription2->id,
            'drug_id' => $lisinopril->id,
            'quantity_prescribed' => 30,
            'quantity_dispensed' => 0,
            'dosage_instructions' => 'Take 1 tablet once daily in the morning',
            'duration_days' => 30,
        ]);

        // Create sample sales
        $cashier = User::where('role', 'cashier')->first();
        $paracetamol = Drug::where('name', 'like', '%Paracetamol%')->first();
        $vitaminD = Drug::where('name', 'like', '%Vitamin D3%')->first();

        $sale1 = Sale::create([
            'sale_number' => 'SALE-' . str_pad('1', 6, '0', STR_PAD_LEFT),
            'customer_id' => $customer1->id,
            'user_id' => $cashier->id,
            'prescription_id' => null,
            'subtotal' => 28.98,
            'tax_amount' => 2.90,
            'discount_amount' => 0,
            'total_amount' => 31.88,
            'amount_paid' => 35.00,
            'change_amount' => 3.12,
            'payment_method' => 'cash',
            'status' => 'completed',
            'notes' => 'Over-the-counter purchase',
        ]);

        SaleItem::create([
            'sale_id' => $sale1->id,
            'drug_id' => $paracetamol->id,
            'prescription_item_id' => null,
            'quantity' => 1,
            'unit_price' => 12.99,
            'total_price' => 12.99,
        ]);

        SaleItem::create([
            'sale_id' => $sale1->id,
            'drug_id' => $vitaminD->id,
            'prescription_item_id' => null,
            'quantity' => 1,
            'unit_price' => 15.99,
            'total_price' => 15.99,
        ]);

        // Update stock quantities
        $paracetamol->decrement('stock_quantity', 1);
        $vitaminD->decrement('stock_quantity', 1);
    }
}