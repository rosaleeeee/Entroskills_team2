<x-app-layout>
    <!DOCTYPE html>
    <html lang="en"> <!-- Changed lang attribute to 'en' for English -->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Drag and Drop to Assign Users</title>
        <link rel="stylesheet" href="{{ asset('affect_mbti.css') }}">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        @include('layouts.sidebar')
        
        @php
            $jobs = [
                'Product Manager' => 'product_manager.png',
                'Marketing Manager' => 'marketing_manager.png',
                'Sales Manager' => 'sales_manager.png',
                'Customer Service Manager' => 'customer_service_manager.png',
                'Chief Financial Officer (CFO)' => 'cfo.png',
                'Chief Operating Officer (COO)' => 'coo.png',
                'Project Manager' => 'project_manager.png',
                'Partnerships Manager' => 'partnerships_manager.png',
                'Accountant' => 'accountant.png',
            ];
        @endphp

        <div class="big">
            <h1 class="titre">Choose your team's roles</h1><br>
            <div class="users-container">
                <div id="users">
                    @foreach($users as $user)
                        <div class="user" draggable="true" id="user-{{ $user->id }}" data-mbti-type="{{ $user->mbti_type }}">{{ $user->name }} - {{$user->mbti_type}}</div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="positions-container">
                <div id="positions">
                    @foreach($positions as $key => $position)
                        <div class="position" id="position-{{ $key + 1 }}">
                            <div class="xx"><img class="job_image" src="{{ asset('images_mbti/' . $jobs[$position]) }}" alt="image"></div>
                            <h3 class="pos">{{ $position }}</h3>
                            <div class="xx"><div class="droppable-area" data-job="{{ $position }}"></div></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button id="showResults" disabled>Validate</button>

            <!-- Modal Window -->
            <div id="confirmationModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>After all the users have completed this step, you will be able to see the results.</p>
                </div>
            </div>
            <div class="ccon">
                <button id="redirectToAffichage" class="btn-affichage1">View Finalized Positions</button>
                <button class="btn-affichage" onclick="window.location.href='affichage_poste'">View Finalized Positions</button>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const users = document.querySelectorAll(".user");
                const droppableAreas = document.querySelectorAll(".droppable-area");
                const showResultsButton = document.getElementById("showResults");
                const modal = document.getElementById("confirmationModal");
                const span = document.querySelector(".close");
                const redirectToAffichageButton = document.getElementById("redirectToAffichage");

                // Define compatible job roles for each MBTI type
                const mbtiJobCompatibility = {
                    'INTJ': ['Product Manager', 'Sales Manager', 'Accountant'],
                    'ENFP': ['Product Manager', 'Marketing Manager', 'Partnerships Manager'],
                    'ENTJ': ['Product Manager', 'Sales Manager', 'Partnerships Manager'],
                    'INFP': ['Marketing Manager', 'Chief Operating Officer (COO)', 'Accountant'],
                    'ESTP': ['Marketing Manager', 'Sales Manager', 'Project Manager'],
                    'ENFJ': ['Marketing Manager', 'Customer Service Manager', 'Chief Operating Officer (COO)'],
                    'ISTJ': ['Sales Manager', 'Chief Financial Officer (CFO)', 'Accountant'],
                    'ISFP': ['Customer Service Manager', 'Partnerships Manager', 'Project Manager'],
                    'INTP': ['Chief Financial Officer (CFO)', 'Chief Operating Officer (COO)', 'Accountant'],
                    'ESFJ': ['Chief Financial Officer (CFO)', 'Project Manager', 'Partnerships Manager'],
                    'ESTJ': ['Chief Financial Officer (CFO)', 'Sales Manager', 'Partnerships Manager'],
                    'ISTP': ['Project Manager', 'Sales Manager', 'Chief Operating Officer (COO)'],
                    'ESFP': ['Sales Manager', 'Project Manager', 'Customer Service Manager'],
                    'ENTP': ['Sales Manager', 'Marketing Manager', 'Project Manager'],
                    'ISFJ': ['Customer Service Manager', 'Accountant', 'Chief Operating Officer (COO)'],
                    'INFJ': ['Customer Service Manager', 'Partnerships Manager', 'Project Manager']
                };

                users.forEach(user => {
                    user.addEventListener("dragstart", dragStart);
                });

                droppableAreas.forEach(area => {
                    area.addEventListener("dragover", allowDrop);
                    area.addEventListener("drop", drop);
                });

                function dragStart(event) {
                    event.dataTransfer.setData("text", event.target.id);
                }

                function allowDrop(event) {
                    event.preventDefault();
                }

                function drop(event) {
                    event.preventDefault();
                    const userId = event.dataTransfer.getData("text");
                    const user = document.getElementById(userId);
                    const targetArea = event.target.closest(".droppable-area");

                    if (targetArea && targetArea.children.length === 0) {
                        const jobTitle = targetArea.dataset.job;
                        const userMbtiType = user.dataset.mbtiType;

                        // Check if the dropped user's MBTI type can take this job role
                        if (mbtiJobCompatibility[userMbtiType] && mbtiJobCompatibility[userMbtiType].includes(jobTitle)) {
                            targetArea.appendChild(user);
                            checkAllAssigned();
                        } else {
                            alert(`The MBTI type (${userMbtiType}) of ${user.textContent.trim()} is not compatible with the job role (${jobTitle}).`);
                        }
                    }
                }

                function checkAllAssigned() {
                    let allAssigned = true;
                    droppableAreas.forEach(area => {
                        if (area.children.length === 0) {
                            allAssigned = false;
                        }
                    });
                    showResultsButton.disabled = !allAssigned;
                    if (allAssigned) {
                        redirectToAffichageButton.disabled = false;
                    } else {
                        redirectToAffichageButton.disabled = false;
                    }
                }

                showResultsButton.addEventListener("click", () => {
                    users.forEach(user => {
                        user.setAttribute('draggable', 'false');
                    });

                    droppableAreas.forEach(area => {
                        area.removeEventListener("dragover", allowDrop);
                        area.removeEventListener("drop", drop);
                    });

                    modal.style.display = "block";

                    updateTemporaryJobs();
                });

                span.addEventListener("click", () => {
                    modal.style.display = "none";
                });

                window.addEventListener("click", event => {
                    if (event.target === modal) {
                        modal.style.display = "none";
                    }
                });

                function updateTemporaryJobs() {
                    const positionsData = [];

                    droppableAreas.forEach(area => {
                        const user = area.querySelector(".user");
                        if (user) {
                            const jobTitleElement = area.closest('.position').querySelector(".pos");
                            if (jobTitleElement) {
                                positionsData.push({
                                    userId: user.id.split('-')[1],
                                    job: jobTitleElement.textContent.trim()
                                });
                            }
                        }
                    });

                    $.ajax({
                        url: '/update-temporary-jobs',
                        method: 'POST',
                        data: {
                            positions: positionsData,
                            _token: '{{ csrf_token() }}'
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert('Your suggestions have been taken into consideration');
                        },
                        error: function(xhr, status, error) {
                            alert('An error occurred while updating the temporary assignments.');
                            console.error(xhr.responseText);
                        }
                    });
                }

                function checkAllUsersCompleted() {
                    $.ajax({
                        url: '/check-all-users-completed',
                        method: 'GET',
                        success: function(response) {
                                finalizeJobs();
                           
                        },
                        error: function(xhr, status, error) {
                            alert('Error checking completion status.');
                            console.error(error);
                        }
                    });
                }

                function finalizeJobs() {
                    const positionsData = [];

                    droppableAreas.forEach(area => {
                        const user = area.querySelector(".user");
                        if (user) {
                            const jobTitleElement = area.closest('.position').querySelector(".pos");
                            if (jobTitleElement) {
                                positionsData.push({
                                    userId: user.id.split('-')[1],
                                    job: jobTitleElement.textContent.trim()
                                });
                            }
                        }
                    });

                    $.ajax({
                        url: '/finalize-jobs',
                        method: 'POST',
                        data: {
                            positions: positionsData,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            alert('Jobs have been finalized and updated successfully.');
                            redirectToAffichageButton.disabled = false;
                            redirectToAffichageButton.addEventListener("click", function() {
                                window.location.href = "/affichage_poste";
                            });
                        },
                        error: function(xhr, status, error) {
                            alert('Error finalizing jobs.');
                            console.error(error);
                        }
                    });
                }

                setInterval(checkAllUsersCompleted, 600000); // Check every 60 seconds
            });
        </script>
    </body>
    </html>
</x-app-layout>
