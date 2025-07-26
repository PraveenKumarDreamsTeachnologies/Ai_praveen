<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Your Symptoms</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom styles for a bit more flair */
        body {
            background-color: #f0f4f8; /* Light blue-gray background */
        }
        .form-container {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        .input-field {
            border: 1px solid #cbd5e0; /* Light gray border */
            border-radius: 8px;
            padding: 12px 16px;
            width: 100%;
            transition: border-color 0.2s ease-in-out;
        }
        .input-field:focus {
            outline: none;
            border-color: #4c51bf; /* Indigo on focus */
            box-shadow: 0 0 0 3px rgba(76, 81, 191, 0.2);
        }
        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px 16px;
            border: 2px dashed #a0aec0; /* Dashed gray border */
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            color: #4a5568; /* Darker gray text */
        }
        .file-upload-label:hover {
            border-color: #4c51bf; /* Indigo on hover */
            color: #4c51bf;
        }
        .file-upload-label svg {
            margin-right: 8px;
        }
        .submit-button {
            background-color: #4c51bf; /* Indigo button */
            color: #ffffff;
            padding: 14px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.2s ease-in-out;
        }
        .submit-button:hover {
            background-color: #3b429b; /* Darker indigo on hover */
        }
        .preview-image {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="form-container p-8 w-full max-w-2xl mx-auto">
        <h2 class="text-3xl font-extrabold text-gray-900 mb-6 text-center">Report Your Symptoms</h2>
        <p class="text-gray-600 text-center mb-8">Please describe your symptoms and upload any relevant images for a comprehensive assessment.</p>

        <form action="{{ route('analyze') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div>
                <label for="symptoms" class="block text-sm font-medium text-gray-700 mb-2">Describe your symptoms:</label>
                <textarea id="symptoms" name="symptoms" rows="7" class="input-field resize-y" placeholder="e.g., 'I have a persistent cough and a sore throat. My temperature is 38.5°C. I've also noticed some red spots on my skin.'"></textarea>
                @error('symptoms')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload relevant images (optional):</label>
                <label for="images" class="file-upload-label">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    <span>Click to select images (Max 5 images)</span>
                    <input type="file" id="images" name="images[]" multiple accept="image/*" class="hidden" onchange="previewImages(event)">
                </label>
                <p class="mt-2 text-sm text-gray-500">Accepted formats: JPG, PNG. Max file size: 5MB per image.</p>
                @error('images')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('images.*') {{-- For individual image errors --}}
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <div id="image-preview" class="mt-4 flex flex-wrap gap-4">
                    </div>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="submit-button">
                    Submit Symptoms
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImages(event) {
            const previewContainer = document.getElementById('image-preview');
            previewContainer.innerHTML = ''; // Clear previous previews

            const files = event.target.files;
            if (files) {
                if (files.length > 5) {
                    alert('You can upload a maximum of 5 images.');
                    event.target.value = ''; // Clear selected files
                    return;
                }

                Array.from(files).forEach(file => {
                    if (file.size > 5 * 1024 * 1024) { // 5MB limit
                        alert(`File "${file.name}" is too large. Maximum file size is 5MB.`);
                        event.target.value = ''; // Clear selected files
                        previewContainer.innerHTML = '';
                        return;
                    }

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('preview-image');
                        img.alt = file.name;
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
</body>
</html>