<x-app-layout>
    
            <!-- Page Content -->

   
    @include('layouts.sidebar')

<!-- end navbar -->   

<link href="{{ asset('level-obj.css') }}" rel="stylesheet">
<body>
    <div id="content">
        <div id="left">
            <h1>Understanding the Business Model</h1>
            <p>A business model explains how a company creates, delivers, and captures value. 
                It serves as a blueprint for your business strategy, detailing how you plan to 
                achieve your goals and generate revenue. 
                In this level, you will learn the fundamental components of a business model and 
                understand how they fit together to create a successful business strategy. 
                Let's get started with an interactive exercise!</p></br>
            <h3>Objectives</h3>
            </br>
           
            <ul>
                <ol>+Understand the key components of a business model.</ol>
          
                <ol>+Learn how each component contributes to creating, delivering, and capturing value.</ol>
         
                <ol>+Reinforce understanding through an interactive and engaging exercise.</ol>
         
            </ul>
        </div>
        <div id="right">
            <img src="{{ asset('images/Level1.png') }}" alt="Illustration">
        </div>
    </div>
    <div class="conteneur">
    <button class="start_level_btn" onclick="window.location.href='level1/start-level1'">start</button>
</div>
    
</body>
</x-app-layout>
