
<x-app-layout>
<div class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded-lg shadow-lg w-11/12 sm:w-3/4 md:w-1/2 lg:w-1/3">
            <!-- Display Success Message -->
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Success!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <ul class="list-disc pl-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="text-2xl font-semibold text-center mb-4">Create a new employee</h2>
            <p class="text-gray-600 text-center mb-6">Enter employee details.</p>
            <form method="POST" action="{{ route('employee.save') }}" enctype="multipart/form-data">
                @csrf
                @method('post')
                
                <!-- First Name -->
                <div class="mb-4">
                    <label for="firstname" class="block text-gray-700 text-sm font-semibold mb-2">First Name *</label>
                    <input type="text" id="firstname" name="firstname" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="John" value="{{ old('firstname') }}">
                    @error('firstname')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="mb-4">
                    <label for="lastname" class="block text-gray-700 text-sm font-semibold mb-2">Last Name *</label>
                    <input type="text" id="lastname" name="lastname" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="Doe" value="{{ old('lastname') }}">
                    @error('lastname')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Date of Birth -->
                <div class="mb-4">
                    <label for="date_of_birth" class="block text-gray-700 text-sm font-semibold mb-2">Date of Birth *</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Education Qualification -->
                <div class="mb-4">
                    <label for="education_qualification" class="block text-gray-700 text-sm font-semibold mb-2">Education Qualification *</label>
                    <input type="text" id="education_qualification" name="education_qualification" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="Bachelor's Degree" value="{{ old('education_qualification') }}">
                    @error('education_qualification')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="mb-4">
                    <label for="address" class="block text-gray-700 text-sm font-semibold mb-2">Address *</label>
                    <textarea id="address" name="address" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="123 Main St">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-semibold mb-2">Email Address *</label>
                    <input type="email" id="email" name="email" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="john.doe@example.com" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div class="mb-4">
                    <label for="phone" class="block text-gray-700 text-sm font-semibold mb-2">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500" required placeholder="123-456-7890" value="{{ old('phone') }}">
                    @error('phone')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Photo Upload -->
                <div class="mb-4">
                    <label for="photo" class="block text-gray-700 text-sm font-semibold mb-2">Photo</label>
                    <input type="file" id="photo" name="photo" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500">
                    @error('photo')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Resume Upload -->
                <div class="mb-4">
                    <label for="resume" class="block text-gray-700 text-sm font-semibold mb-2">Resume</label>
                    <input type="file" id="resume" name="resume" class="form-input w-full px-4 py-2 border rounded-lg text-gray-700 focus:ring-blue-500">
                    @error('resume')
                        <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Register</button>
            </form>
        </div>
    </div>



</x-app-layout>




