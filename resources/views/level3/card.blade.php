<x-app-layout>
    <link href="{{ asset('card.css') }}" rel="stylesheet">
    <!-- Page Content -->
    <script>
        function togglePopup(popupId) {
            document.getElementById(popupId).classList.toggle("active");
        }
    </script>
    <main>
    <h2 style="font-size: 20px; color: #5398D4; text-align: center; margin-top: 18px;">
    Explore Key Roles: Click 'Read More' to Discover Detailed Descriptions of Each Position.
</h2>
        <div style="display: flex; height: 85vh;">
            <div style="width: 100px; color: black; padding: 20px;">
                <!-- start navbar --> 
                @include('layouts.sidebar')    
                <!-- end navbar -->
            </div>

            <section class="container">
                <div class="cards grid">
                    <!-- Card 1 -->
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/pm1.png') }}" alt="Community Manager"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Product Manager</h1>
                            <button class="B" onclick="togglePopup('popup-1')">Read More</button>
                        </div>
                    </div>
                    <!-- Card 2 -->
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/sm.png') }}" alt="Sales Manager"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Sales Manager</h1>
                            <button class="B" onclick="togglePopup('popup-2')">Read More</button>
                        </div>
                    </div>
                    <!-- Card 3 -->
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/pm.png') }}" alt="Partnership Manager"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Partnership Manager</h1>
                            <button  class="B" onclick="togglePopup('popup-3')">Read More</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/csm.png') }}" alt="Customer Service Manager"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Customer Service Manager</h1>
                            <button class="B" onclick="togglePopup('popup-4')">Read More</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/mm.png') }}" alt="Marketing manager"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Marketing manager</h1>
                            <button class="B" onclick="togglePopup('popup-5')">Read More</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/cfo.png') }}" alt="Chief Financial Officer"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Chief Financial Officer</h1>
                            <button class="B" onclick="togglePopup('popup-6')">Read More</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/coo.png') }}" alt="Chief Operating Officer"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Chief Operating Officer</h1>
                            <button class="B" onclick="togglePopup('popup-7')">Read More</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/pjm.png') }}" alt="Project Manager"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading">Project Manager</h1>
                            <button class="B" onclick="togglePopup('popup-8')">Read More</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="img-box">
                           <img src="{{ asset('images/a.png') }}" alt=" Accountant"> 
                        </div>
                        <div class="card-content">
                            <h1 class="card-heading"> Accountant</h1>
                            <button class="B" onclick="togglePopup('popup-9')">Read More</button>
                        </div>
                    </div>
                    <!-- Add more cards as needed -->
                </div>
            </section>
            <button class="bottom-right-button" onclick="window.location.href='howtoplay'">DONE</button>
        </div>
    </main>

    <!-- Popup 1 -->
    <div class="popup" id="popup-1">
        <div class="overlay" onclick="togglePopup('popup-1')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-1')">&times;</div>
            <h1>Product Manager</h1>
            <p>  oversees the entire lifecycle of a product, from planning and development to launch and ongoing refinement. They drive strategy, gather insights from customers, and collaborate with teams to ensure products meet market demands and business goals effectively.</p>
        </div>
    </div>
    <!-- Popup 2 -->
    <div class="popup" id="popup-2">
        <div class="overlay" onclick="togglePopup('popup-2')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-2')">&times;</div>
            <h1>Sales Manager</h1>
            <p>Leads the sales team to meet or exceed sales targets. Develops sales strategies, manages customer relationships, and analyzes sales data to identify areas for improvement. Ensures that the sales team is motivated and equipped with the necessary tools and training.</p>
        </div>
    </div>
    <!-- Popup 3 -->
    <div class="popup" id="popup-3">
        <div class="overlay" onclick="togglePopup('popup-3')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-3')">&times;</div>
            <h1>Partnership Manager</h1>
            <p>Develops and maintains strategic partnerships with other companies. Identifies potential partners, negotiates agreements, and works to ensure mutual benefits from the partnership. Monitors the performance of partnerships and addresses any challenges.</p>
        </div>
    </div>
    <div class="popup" id="popup-4">
        <div class="overlay" onclick="togglePopup('popup-4')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-4')">&times;</div>
            <h1>Customer Service Manager</h1>
            <p>Oversees the customer service department to ensure customers receive prompt and effective support.  
         and implements policies to improve customer satisfaction.</p>
        </div>
    </div>
    <div class="popup" id="popup-5">
        <div class="overlay" onclick="togglePopup('popup-5')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-5')">&times;</div>
            <h1>Marketing Manager</h1>
            <p>Develops and implements marketing strategies to promote a company's products or services. Oversees market research, advertising campaigns, social media, and other marketing efforts to increase brand awareness and drive sales.</p>
        </div>
    </div>
    <div class="popup" id="popup-6">
        <div class="overlay" onclick="togglePopup('popup-6')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-6')">&times;</div>
            <h1>Chief Financial Officer</h1>
            <p>Manages the financial actions of a company, including budgeting, forecasting, and financial planning, and ensuring the company's financial health. Works closely with other executives to develop and implement strategic plans.</p>
        </div>
    </div>
    <div class="popup" id="popup-7">
        <div class="overlay" onclick="togglePopup('popup-7')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-7')">&times;</div>
            <h1>Chief Operating Officer </h1>
            <p>Oversees the daily operations of a company. Responsible for implementing business strategies, managing the operational processes, and ensuring efficient and effective operations. Works closely with the CEO and other executives to align operations with the company's goals.</p>
        </div>
    </div>
    <div class="popup" id="popup-8">
        <div class="overlay" onclick="togglePopup('popup-8')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-8')">&times;</div>
            <h1>Project Manager</h1>
            <p> Plans, executes, and closes projects. Ensures that the project meets the requirements and is delivered on time and within budget. Communicates progress and resolves any issues that arise during the project lifecycles.</p>
        </div>
    </div>
    <div class="popup" id="popup-9">
        <div class="overlay" onclick="togglePopup('popup-9')"></div>
        <div class="content">
            <div class="close-btn" onclick="togglePopup('popup-9')">&times;</div>
            <h1>Accountant</h1>
            <p>Manages financial records, prepares financial statements, and ensures compliance with accounting standards and regulations. Handles bookkeeping, tax filings, and financial analysis. Provides insights and recommendations based on financial data to support business decisions.</p>
        </div>
    </div>
    <!-- Add more popups as needed -->
</x-app-layout>
