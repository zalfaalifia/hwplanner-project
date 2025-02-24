<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Ensure the background covers the entire page */
        html, body {
            height: 100%;
            margin: 0;
        }

        /* Animated background with cheerful blue gradient */
        .background-animation {
            position: fixed; /* Use fixed position to ensure it stays in place */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(-45deg, #d4f4fd, #78b5ff);
            background-size: 400% 400%;
            animation: gradientAnimation 10s ease infinite;
            z-index: -1; /* Keep the background behind the content */
        }

        /* Animation for background gradient movement */
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        /* Table Styles */
        thead th:first-child {
            border-top-left-radius: 0.5rem; /* Top-left corner */
        }
        thead th:last-child {
            border-top-right-radius: 0.5rem; /* Top-right corner */
        }

        /* Raised text effect for all table text, ensure text is white and has a shadow */
        table td, table th, table td * {
            color: white !important; /* Force white text color */
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); /* Raised text effect */
            transition: text-shadow 0.3s ease;
        }

        /* Make sure text inside the table stays white, even the status column */
        table .task-status {
            color: white !important; /* Force white color for the status column */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6); /* Raised text effect */
        }

        /* Hover effect for text to make it pop more */
        table td:hover, table th:hover, table td *:hover {
            text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.8); /* Stronger shadow on hover */
        }

        /* Ensure the content remains readable */
        .table {
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background to improve contrast */
        }

        /* Optional: Make sure buttons and form elements have the proper color */
        .btn, .navbar-nav .nav-link {
            color: white !important;
        }
    </style>
</head>
<body>

    <!-- Background Animation -->
    <div class="background-animation"></div>

            <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">HomeWork Planner</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Welcome User -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">Welcome, {{ $LoggedUserInfo->name }}</a>
                    </li>
                    <!-- Kalender page -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('calendar.index') }}">Calendar</a>
                    </li>
                    <!-- Logout Button -->
                    <li class="nav-item">
                        <form action="{{ route('user.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger nav-link" style="border:none; background:none;">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Main Container -->
    <div class="container mt-5 pt-5">
        <div class="row mb-4">
            <div class="col text-end mb-4">
                <a href="{{ route('user.addtask') }}" class="btn btn-warning">Add Task</a>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <label for="filterStatus" class="form-label">Filter by Status</label>
                <select class="form-select" id="filterStatus" onchange="filterTasks()">
                    <option value="all">All</option>
                    <option value="completed">Completed</option>
                    <option value="pending">Pending</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="filterDueDate" class="form-label">Filter by Due Date</label>
                <select class="form-select" id="filterDueDate" onchange="filterTasks()">
                    <option value="">All Dates</option>
                    <option value="today">Today</option>
                    <option value="tomorrow">Tomorrow</option>
                    <option value="next7days">Next 7 Days</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="searchTask" class="form-label">Search by Title</label>
                <input type="text" class="form-control" id="searchTask" onkeyup="filterTasks()" placeholder="Search tasks...">
            </div>
        </div>

        <!-- Tasks Table -->
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped" id="tasksTable">
                    <thead style="background-color: #343a40; color:white">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Due Date</th>
                            <th scope="col">Status</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tasksBody">
                        @if($tasks && $tasks->count())
                            @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        @if($task->image)
                                            <img src="{{ asset('storage/' . $task->image) }}" alt="{{ $task->title }}" class="img-thumbnail" style="width: 100px; height: auto;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d M Y') }}</td>
                                    <td class="task-status">{{ $task->completed ? 'Completed' : 'Pending' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('tasks.show', ['id' => $task->id]) }}" class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">No tasks found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and optional Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Filtering and SweetAlert Scripts -->
    <script>
        function filterTasks() {
            const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
            const dueDateFilter = document.getElementById('filterDueDate').value.toLowerCase();
            const searchFilter = document.getElementById('searchTask').value.toLowerCase();
            const rows = document.querySelectorAll('#tasksBody tr');

            rows.forEach(row => {
                const status = row.querySelector('.task-status').innerText.toLowerCase();
                const dueDate = row.cells[3].innerText.toLowerCase();
                const title = row.cells[1].innerText.toLowerCase();

                let statusMatch = (statusFilter === 'all' || status.includes(statusFilter));
                let dateMatch = filterDueDate(dueDate, dueDateFilter);
                let searchMatch = (title.includes(searchFilter));

                if (statusMatch && dateMatch && searchMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function filterDueDate(dueDate, filter) {
            const today = new Date();
            const taskDate = new Date(dueDate);

            if (filter === 'today') {
                return today.toDateString() === taskDate.toDateString();
            } else if (filter === 'tomorrow') {
                let tomorrow = new Date(today);
                tomorrow.setDate(today.getDate() + 1);
                return tomorrow.toDateString() === taskDate.toDateString();
            } else if (filter === 'next7days') {
                let nextWeek = new Date(today);
                nextWeek.setDate(today.getDate() + 7);
                return taskDate >= today && taskDate <= nextWeek;
            }
            return true;
        }

        // SweetAlert for delete confirmation
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('form');
                const taskTitle = this.closest('tr').querySelector('td:nth-child(2)').innerText;

                Swal.fire({
                    title: `Are you sure you want to delete "${taskTitle}"?`,
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire('Deleted!', 'Your task has been deleted.', 'success');
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire('Cancelled', 'Your task is safe :)', 'error');
                    }
                });
            });
        });
    </script>
</body>
</html>
