<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Remedies & Products | Modern Health</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body {
            /* A subtle gradient for a modern background feel */
            background-color: #f0f4f8;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            font-family: 'Inter', sans-serif;
        }
        .container-box {
            /* Glassmorphism effect: semi-transparent background with a blur */
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .result-image {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .result-image:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .product-card {
            background-color: #ffffff;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            overflow: hidden; /* To keep the image corners rounded */
            border-top: 4px solid #4f46e5; /* Accent color border */
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        .product-image {
            width: 100%;
            height: 160px;
            object-fit: contain;
            margin-bottom: 16px;
            background-color: #f8fafc;
            transition: transform 0.3s ease-in-out;
        }
        .product-card:hover .product-image {
            transform: scale(1.05);
        }
        .matched-badge {
            display: inline-flex;
            align-items: center;
            background-color: #e0e7ff;
            color: #3730a3;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-right: 6px;
            margin-bottom: 6px;
            border: 1px solid #c7d2fe;
        }
        .buy-button {
            background-color: #4f46e5; /* Indigo */
            color: #ffffff;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: 700;
            text-align: center;
            transition: all 0.3s ease-in-out;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .buy-button:hover {
            background-color: #4338ca;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.4);
            transform: translateY(-2px);
        }
        .virtual-badge {
            background-color: #fffbeb;
            color: #b45309;
            padding: 3px 8px;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 700;
            margin-left: 8px;
            border: 1px solid #fde68a;
        }
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.5rem; /* 24px */
            line-height: 2rem; /* 32px */
            font-weight: 800;
            color: #1e293b; /* slate-800 */
            margin-bottom: 1.5rem; /* 24px */
        }
        .section-box {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4 sm:p-6 md:p-8">
    <div class="container-box p-6 sm:p-8 md:p-12 w-full max-w-6xl mx-auto">
        <header class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight">Your Health Analysis</h1>
            <p class="mt-4 text-lg text-slate-600">Remedies & Products Based On Your Report</p>
        </header>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-8 rounded-r-lg shadow" role="alert">
                <p class="font-bold">Success!</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 mb-8 rounded-r-lg shadow" role="alert">
                <p class="font-bold">Error!</p>
                <p>{{ session('error') }}</p>
            </div>
        @endif
        @if (isset($infoMessage) && $infoMessage)
            <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-800 p-4 mb-8 rounded-r-lg shadow" role="alert">
                <p class="font-bold">Info</p>
                <p>{{ $infoMessage }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            <div class="section-box bg-white">
                <h3 class="section-header">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    <span>Your Reported Symptoms</span>
                </h3>
                <p class="text-slate-700 leading-relaxed">{{ $userSymptomsDescription }}</p>
            </div>

            <div class="section-box bg-white">
                 <h3 class="section-header">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                    <span>Uploaded Images</span>
                </h3>
                @if (!empty($imagePaths))
                    <div class="flex flex-wrap gap-4">
                        @foreach ($imagePaths as $imagePath)
                            <img src="{{ $imagePath }}" alt="Uploaded Symptom Image" class="result-image shadow-md">
                        @endforeach
                    </div>
                @else
                    <p class="text-slate-500">No images were uploaded.</p>
                @endif
            </div>
        </div>

        <div class="section-box bg-indigo-50 border-indigo-200">
            <h3 class="section-header">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18" /></svg>
                <span>Identified Symptoms</span>
            </h3>
            @if (!empty($identifiedSymptoms))
                <div class="flex flex-wrap">
                    @foreach ($identifiedSymptoms as $symptom)
                        <span class="matched-badge">{{ $symptom }}</span>
                    @endforeach
                </div>
            @else
                <p class="text-slate-600">No specific symptoms could be clearly identified from your description.</p>
            @endif
        </div>

        <div class="section-box bg-sky-50 border-sky-200">
            <h3 class="section-header">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                <span>Gemini's Preliminary Advice</span>
            </h3>
            <p class="text-sky-800 leading-relaxed">{{ $geminiMedicalAdvice }}</p>
            <div class="mt-6 bg-amber-50 border border-amber-200 text-amber-900 text-sm p-4 rounded-lg flex items-start gap-3">
                 <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0 mt-0.5 text-amber-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.21 3.03-1.742 3.03H4.42c-1.532 0-2.492-1.696-1.742-3.03l5.58-9.92zM10 13a1 1 0 110-2 1 1 0 010 2zm-1.75-5.25a.75.75 0 00-1.5 0v3.5a.75.75 0 001.5 0v-3.5z" clip-rule="evenodd" />
                 </svg>
                <div>
                    <strong class="font-bold">Disclaimer:</strong> This information is for general knowledge and informational purposes only, and does not constitute medical advice. It is essential to consult with a qualified healthcare professional for any health concerns or before making any decisions related to your health or treatment.
                </div>
            </div>
        </div>

        <div class="mt-16">
            <h3 class="text-3xl font-extrabold text-slate-900 mb-8 text-center">Recommended Remedies & Products</h3>
            @if (!empty($allSuggestedProducts))
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($allSuggestedProducts as $suggestion)
                        <div class="product-card group">
                            <div class="p-6 flex flex-col h-full">
                                {{-- Product Image --}}
                                @if (isset($suggestion['is_virtual']) && $suggestion['is_virtual'])
                                    <img src="{{ $suggestion['image_url'] }}" alt="{{ $suggestion['name'] }} (Virtual Product)" class="product-image">
                                @else
                                    <img src="{{ asset('assets/images/placeholder-image.jpg') }}" alt="{{ $suggestion['product']->name }} (Real Product)" class="product-image">
                                @endif

                                <h4 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-indigo-600 transition-colors duration-300">
                                    @if (isset($suggestion['is_virtual']) && $suggestion['is_virtual'])
                                        {{ $suggestion['name'] }} <span class="virtual-badge">Virtual Product</span>
                                    @else
                                        {{ $suggestion['product']->name }}
                                    @endif
                                </h4>
                                <p class="text-slate-600 text-sm mb-4 flex-grow">
                                    @if (isset($suggestion['is_virtual']) && $suggestion['is_virtual'])
                                        {{ $suggestion['description'] }}
                                    @else
                                        {{ Str::limit($suggestion['product']->description, 120) }}
                                    @endif
                                </p>
                                <p class="text-3xl font-extrabold text-indigo-600 mb-5">
                                    @if (isset($suggestion['is_virtual']) && $suggestion['is_virtual'])
                                        {{ $suggestion['price_display'] }}
                                    @else
                                        ₹{{ number_format($suggestion['product']->price, 2) }}
                                    @endif
                                </p>

                                @if (isset($suggestion['matched_symptoms']))
                                    <p class="text-xs font-semibold text-slate-500 mb-2 uppercase tracking-wider">Addresses:</p>
                                    <div class="flex flex-wrap mb-6">
                                        @foreach ($suggestion['matched_symptoms'] as $matchedSymptom)
                                            <span class="matched-badge">{{ $matchedSymptom }}</span>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="mt-auto">
                                    <form action="{{ route('purchase.product') }}" method="POST">
                                        @csrf
                                        @if (isset($suggestion['is_virtual']) && $suggestion['is_virtual'])
                                            <input type="hidden" name="product_type" value="virtual">
                                            <input type="hidden" name="product_name" value="{{ $suggestion['name'] }}">
                                            <input type="hidden" name="product_description" value="{{ $suggestion['description'] }}">
                                            <input type="hidden" name="price_display" value="{{ $suggestion['price_display'] }}">
                                            <input type="hidden" name="matched_symptoms" value="{{ json_encode($identifiedSymptoms) }}">
                                        @else
                                            <input type="hidden" name="product_type" value="real">
                                            <input type="hidden" name="product_id" value="{{ $suggestion['product']->id }}">
                                        @endif
                                        <button type="submit" class="buy-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                            </svg>
                                            <span>Purchase Now</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 px-6 bg-slate-50 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="mt-4 text-center text-slate-600 text-lg font-medium">No relevant products or remedies found at this time.</p>
                    <p class="text-center text-slate-500 mt-2">Please consult a healthcare professional for a detailed diagnosis. You can also browse our <a href="{{ route('products.listing.by.symptoms') }}" class="text-indigo-600 font-semibold hover:underline">full catalog</a>.</p>
                </div>
            @endif
        </div>

        <div class="text-center mt-16 border-t border-slate-200 pt-10">
            <a href="{{ route('ask') }}" class="inline-flex items-center px-8 py-4 border border-transparent text-base font-bold rounded-xl shadow-sm text-white bg-slate-800 hover:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500 transition-transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm.707-10.293a1 1 0 00-1.414-1.414l-3 3a1 1 0 001.414 1.414L10 9.414l.293.293a1 1 0 001.414-1.414l-1-1z" clip-rule="evenodd" />
                </svg>
                Report New Symptoms
            </a>
        </div>
    </div>
</body>
</html>