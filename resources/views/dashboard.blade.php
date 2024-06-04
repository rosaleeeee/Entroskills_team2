<x-app-layout>
    
            <!-- Page Content -->

            <main>
            <div style="display: flex; height: 85vh;">
    <div style="width: 100px; ; color: black; padding: 20px;">
        <!-- start navbar --> 
    @include('layouts.sidebar')

<!-- end navbar -->
    </div>
    
    <div class="levels">
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 flex items-center justify-between">
          <div class="flex items-center">
            <img src="Images/L1.png" class="w-12 h-12 mr-4" alt="Image 1">
            <p>{{ __("Business Model") }}</p>
          </div>
          <img src="image2.jpg" class="w-12 h-12" alt="Image 2">
        </div>
      </div>
    </div>
  </div>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 flex items-center justify-between">
          <div class="flex items-center">
            <img src="Images/L2.png" class="w-12 h-12 mr-4" alt="Image 1">
            <p>{{ __("Use Case") }}</p>
          </div>
          <img src="image2.jpg" class="w-12 h-12" alt="Image 2">
        </div>
      </div>
    </div>
  </div>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 flex items-center justify-between">
          <div class="flex items-center">
            <img src="Images/L3.png" class="w-12 h-12 mr-4" alt="Image 1">
            <p>{{ __("Job Description") }}</p>
          </div>
          <img src="image2.jpg" class="w-12 h-12" alt="Image 2">
        </div>
      </div>
    </div>
  </div>
  <div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 flex items-center justify-between">
          <div class="flex items-center">
            <img src="Images/L4.png" class="w-12 h-12 mr-4" alt="Image 1">
            <p>{{ __("Profile") }}</p>
          </div>
          <img src="image2.jpg" class="w-12 h-12" alt="Image 2">
        </div>
      </div>
    </div>
  </div>
</div>
</x-app-layout>
