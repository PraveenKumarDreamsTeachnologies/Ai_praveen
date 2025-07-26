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
                'status' => 'active',
                'solution' => ["fever", "headache", "mild pain"]
            ],
            [
                'name' => 'Ibuprofen 200mg',
                'description' => 'For fever, inflammation, and pain relief',
                'price' => 7.50,
                'stock_quantity' => 180,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["fever", "inflammation", "muscle pain"]
            ],
            [
                'name' => 'Amoxicillin 250mg',
                'description' => 'Antibiotic for bacterial infections causing sore throat',
                'price' => 12.75,
                'stock_quantity' => 90,
                'expiry_date' => Carbon::now()->addYear()->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["sore throat", "bacterial infections"]
            ],
            [
                'name' => 'Dextromethorphan Syrup',
                'description' => 'For dry cough relief',
                'price' => 8.25,
                'stock_quantity' => 120,
                'expiry_date' => Carbon::now()->addMonths(18)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["dry cough"]
            ],
            [
                'name' => 'Loratadine 10mg',
                'description' => 'For allergies and skin rash relief',
                'price' => 6.40,
                'stock_quantity' => 200,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["allergies", "skin rash", "hives"]
            ],
            [
                'name' => 'Salbutamol Inhaler',
                'description' => 'For cough and breathing difficulties in asthma',
                'price' => 15.99,
                'stock_quantity' => 75,
                'expiry_date' => Carbon::now()->addMonths(10)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["asthma", "bronchospasm", "breathing difficulties"]
            ],
            [
                'name' => 'Cetirizine 10mg',
                'description' => 'For skin rash and allergy symptoms',
                'price' => 4.99,
                'stock_quantity' => 150,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["allergies", "itchy skin", "hives"]
            ],
            [
                'name' => 'Hydrocortisone Cream 1%',
                'description' => 'For skin rash and irritation relief',
                'price' => 6.25,
                'stock_quantity' => 60,
                'expiry_date' => Carbon::now()->addMonths(15)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["skin rash", "eczema", "dermatitis"]
            ],
            [
                'name' => 'Guaifenesin Syrup',
                'description' => 'For productive cough and chest congestion',
                'price' => 7.80,
                'stock_quantity' => 95,
                'expiry_date' => Carbon::now()->addYear()->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["chest congestion", "productive cough"]
            ],
            [
                'name' => 'Chlorpheniramine Maleate',
                'description' => 'For cough, cold, and allergy symptoms',
                'price' => 5.20,
                'stock_quantity' => 130,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["cough", "cold", "allergies"]
            ],
               [
                'name' => 'Guaifenesin Syrup (Expectorant)',
                'description' => 'For productive cough with chest congestion, helps loosen mucus',
                'price' => 8.50,
                'stock_quantity' => 120,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["chest congestion", "productive cough", "bronchitis", "mucus relief"]
            ],
            [
                'name' => 'Diphenhydramine HCl 25mg',
                'description' => 'Antihistamine for allergies and sleep aid',
                'price' => 6.25,
                'stock_quantity' => 180,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["allergies", "insomnia", "motion sickness", "itchy skin"]
            ],
            [
                'name' => 'Loperamide 2mg',
                'description' => 'Anti-diarrheal medication for acute diarrhea',
                'price' => 9.99,
                'stock_quantity' => 85,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["diarrhea", "traveler's diarrhea", "bowel control"]
            ],
            [
                'name' => 'Omeprazole 20mg DR Capsules',
                'description' => 'Proton pump inhibitor for acid reflux and heartburn',
                'price' => 12.75,
                'stock_quantity' => 150,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["heartburn", "acid reflux", "GERD", "stomach ulcers"]
            ],
            [
                'name' => 'Meclizine 25mg',
                'description' => 'Anti-vertigo medication for motion sickness and dizziness',
                'price' => 7.40,
                'stock_quantity' => 65,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["vertigo", "motion sickness", "dizziness", "nausea"]
            ],
            [
                'name' => 'Phenylephrine HCl 10mg',
                'description' => 'Nasal decongestant for sinus pressure and congestion',
                'price' => 5.60,
                'stock_quantity' => 200,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["nasal congestion", "sinus pressure", "cold symptoms"]
            ],
            [
                'name' => 'Famotidine 20mg',
                'description' => 'H2 blocker for acid reduction and indigestion relief',
                'price' => 8.95,
                'stock_quantity' => 110,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["heartburn", "indigestion", "acid stomach", "GERD"]
            ],
            [
                'name' => 'Docusate Sodium 100mg',
                'description' => 'Stool softener for occasional constipation relief',
                'price' => 4.25,
                'stock_quantity' => 175,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["constipation", "bowel regularity", "stool softening"]
            ],
            [
                'name' => 'Pseudoephedrine HCl 30mg',
                'description' => 'Nasal decongestant for severe sinus congestion',
                'price' => 9.25,
                'stock_quantity' => 90,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["sinus congestion", "nasal obstruction", "eustachian tube blockage"]
            ],
            [
                'name' => 'Bismuth Subsalicylate 262mg',
                'description' => 'For upset stomach, diarrhea, and nausea relief',
                'price' => 6.75,
                'stock_quantity' => 140,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["diarrhea", "upset stomach", "indigestion", "nausea"]
            ],
            [
                'name' => 'Naproxen Sodium 220mg',
                'description' => 'NSAID for pain, inflammation, and menstrual cramps',
                'price' => 10.50,
                'stock_quantity' => 95,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["pain relief", "inflammation", "menstrual cramps", "arthritis"]
            ],
            [
                'name' => 'Chlorhexidine Mouthwash',
                'description' => 'Antiseptic oral rinse for gingivitis and mouth ulcers',
                'price' => 7.95,
                'stock_quantity' => 60,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["gingivitis", "mouth ulcers", "oral infections", "bad breath"]
            ],
            [
                'name' => 'Miconazole Nitrate 2% Cream',
                'description' => 'Antifungal cream for athlete\'s foot and ringworm',
                'price' => 5.25,
                'stock_quantity' => 85,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["athlete's foot", "ringworm", "jock itch", "fungal infections"]
            ],
             [
                'name' => 'Acetaminophen 500mg Caplets',
                'description' => 'Fast-acting pain reliever and fever reducer',
                'price' => 6.99,
                'stock_quantity' => 300,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["headache", "fever", "muscle aches", "arthritis pain"]
            ],
            [
                'name' => 'Ibuprofen 200mg Tablets',
                'description' => 'NSAID for pain, inflammation and fever',
                'price' => 8.50,
                'stock_quantity' => 250,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["back pain", "menstrual cramps", "toothache", "minor arthritis"]
            ],
            [
                'name' => 'Naproxen Sodium 220mg Tablets',
                'description' => 'Long-lasting pain relief for up to 12 hours',
                'price' => 10.25,
                'stock_quantity' => 180,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["joint pain", "tendonitis", "bursitis", "gout pain"]
            ],
            [
                'name' => 'Aspirin 325mg Tablets',
                'description' => 'Pain reliever also used for heart attack prevention',
                'price' => 5.75,
                'stock_quantity' => 200,
                'expiry_date' => Carbon::now()->addYears(4)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["pain relief", "fever reduction", "heart attack prevention"]
            ],
            [
                'name' => 'Ketoprofen 12.5% Topical Gel',
                'description' => 'Topical NSAID for localized pain relief',
                'price' => 14.99,
                'stock_quantity' => 90,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["knee pain", "elbow pain", "shoulder pain", "sprains"]
            ],

            // 6-10: Cold and Allergy
            [
                'name' => 'Loratadine 10mg Tablets',
                'description' => 'Non-drowsy 24-hour allergy relief',
                'price' => 12.99,
                'stock_quantity' => 150,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["hay fever", "hives", "itchy eyes", "allergic rhinitis"]
            ],
            [
                'name' => 'Phenylephrine HCl 10mg Tablets',
                'description' => 'Nasal decongestant for sinus pressure relief',
                'price' => 7.25,
                'stock_quantity' => 120,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["sinus congestion", "nasal swelling", "ear congestion"]
            ],
            [
                'name' => 'Dextromethorphan HBr 15mg/5ml Syrup',
                'description' => 'Cough suppressant for dry, hacking cough',
                'price' => 9.50,
                'stock_quantity' => 80,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["dry cough", "tickling throat", "post-nasal drip cough"]
            ],
            [
                'name' => 'Guaifenesin 400mg Tablets',
                'description' => 'Expectorant to loosen chest congestion',
                'price' => 8.75,
                'stock_quantity' => 110,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["chest congestion", "thick mucus", "bronchitis"]
            ],
            [
                'name' => 'Chlorpheniramine Maleate 4mg Tablets',
                'description' => 'Antihistamine for allergy and cold symptoms',
                'price' => 6.25,
                'stock_quantity' => 160,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["runny nose", "sneezing", "itchy throat", "watery eyes"]
            ],

            // 11-15: Digestive Health
            [
                'name' => 'Famotidine 20mg Tablets',
                'description' => 'Acid reducer for heartburn relief',
                'price' => 10.99,
                'stock_quantity' => 200,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["heartburn", "acid indigestion", "sour stomach"]
            ],
            [
                'name' => 'Loperamide 2mg Caplets',
                'description' => 'Anti-diarrheal for symptom control',
                'price' => 8.25,
                'stock_quantity' => 140,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["diarrhea", "traveler's diarrhea", "loose stools"]
            ],
            [
                'name' => 'Docusate Sodium 100mg Softgels',
                'description' => 'Stool softener for occasional constipation',
                'price' => 5.99,
                'stock_quantity' => 180,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["constipation", "hard stools", "bowel regularity"]
            ],
            [
                'name' => 'Simethicone 125mg Chewables',
                'description' => 'Anti-gas for bloating and discomfort',
                'price' => 7.50,
                'stock_quantity' => 160,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["gas pain", "bloating", "pressure", "belching"]
            ],
            [
                'name' => 'Bismuth Subsalicylate 262mg Tablets',
                'description' => 'Upset stomach reliever and antacid',
                'price' => 9.25,
                'stock_quantity' => 120,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["nausea", "indigestion", "diarrhea", "heartburn"]
            ],

            // 16-20: Topicals and First Aid
            [
                'name' => 'Hydrocortisone 1% Cream',
                'description' => 'Anti-itch cream for skin irritation',
                'price' => 6.75,
                'stock_quantity' => 90,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["poison ivy", "eczema", "insect bites", "skin rashes"]
            ],
            [
                'name' => 'Antibiotic Ointment 1oz Tube',
                'description' => 'First aid antibiotic for minor cuts',
                'price' => 4.99,
                'stock_quantity' => 150,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["minor cuts", "scrapes", "burns", "skin infections"]
            ],
            [
                'name' => 'Lidocaine 4% Topical Cream',
                'description' => 'Local anesthetic for pain relief',
                'price' => 12.50,
                'stock_quantity' => 70,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["sunburn pain", "minor burns", "bug bites", "skin irritation"]
            ],
            [
                'name' => 'Antifungal Clotrimazole 1% Cream',
                'description' => 'Treatment for fungal skin infections',
                'price' => 8.99,
                'stock_quantity' => 100,
                'expiry_date' => Carbon::now()->addYears(2)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["athlete's foot", "jock itch", "ringworm", "yeast infections"]
            ],
            [
                'name' => 'Calamine Lotion 6oz Bottle',
                'description' => 'Soothing relief for itchy skin',
                'price' => 5.25,
                'stock_quantity' => 80,
                'expiry_date' => Carbon::now()->addYears(3)->format('Y-m-d'),
                'status' => 'active',
                'solution' => ["poison ivy", "chickenpox", "insect bites", "skin irritation"]
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}