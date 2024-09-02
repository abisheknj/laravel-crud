<x-app-layout>

<div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">


		

    <div class="container mx-auto p-4">
    <div class="mb-4 flex justify-end">
    <button onclick="exportTableToExcel()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
        Export
    </button>
</div>


    <!-- Card -->
    <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
        <table id="employees" class="stripe hover w-full" style="padding-top: 1em; padding-bottom: 1em;">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Education Qualification</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->firstname }} {{ $employee->lastname }}</td>
                        <td>{{ $employee->date_of_birth }}</td>
                        <td>{{ $employee->education_qualification }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>
                            <button onclick="openEditModal('{{ $employee->id }}', '{{ $employee->firstname }}', '{{ $employee->lastname }}', '{{ $employee->date_of_birth }}', '{{ $employee->education_qualification }}', '{{ $employee->address }}', '{{ $employee->email }}', '{{ $employee->phone }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </button>

                            <button onclick="confirmDelete('{{ $employee->id }}')" class="bg-blue-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /Card -->

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg ">
        <h2 class="text-xl font-bold mb-4">Edit Employee</h2>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <form id="editForm">
        @csrf
            <input type="hidden" id="employeeId">
            <div class="mb-4">
                <label for="firstname" class="block text-gray-700">First Name</label>
                <input type="text" id="firstname" name="firstname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="lastname" class="block text-gray-700">Last Name</label>
                <input type="text" id="lastname" name="lastname" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="date_of_birth" class="block text-gray-700">Date of Birth</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="education_qualification" class="block text-gray-700">Education Qualification</label>
                <input type="text" id="education_qualification" name="education_qualification" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-gray-700">Address</label>
                <input type="text" id="address" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="mb-4">
                <label for="phone" class="block text-gray-700">Phone</label>
                <input type="tel" id="phone" name="phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div class="flex justify-end">
                <button type="button" onclick="closeEditModal()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
    <!-- /Edit Modal -->
</div>





	<!-- jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

	<!--Datatables -->
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

	<script>
        function openEditModal(id, firstname, lastname, date_of_birth, education_qualification, address, email, phone) {
    document.getElementById('employeeId').value = id;
    document.getElementById('firstname').value = firstname;
    document.getElementById('lastname').value = lastname;
    document.getElementById('date_of_birth').value = date_of_birth;
    document.getElementById('education_qualification').value = education_qualification;
    document.getElementById('address').value = address;
    document.getElementById('email').value = email;
    document.getElementById('phone').value = phone;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}


function confirmDelete(id) {
    if (confirm('Are you sure you want to delete this employee?')) {
        fetch(`/employee/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Employee deleted successfully!');
                location.reload(); // Reload the page to see the updated list
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An unexpected error occurred.');
        });
    }
}


// Example form submission handler
document.getElementById('editForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const id = document.getElementById('employeeId').value;
    const firstname = document.getElementById('firstname').value;
    const lastname = document.getElementById('lastname').value;
    const date_of_birth = document.getElementById('date_of_birth').value;
    const education_qualification = document.getElementById('education_qualification').value;
    const address = document.getElementById('address').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    
    // Handle form submission to update employee details
    // Example AJAX request (assuming you have a route set up to handle this)

    fetch(`employee/update/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            firstname,
            lastname,
            date_of_birth,
            education_qualification,
            address,
            email,
            phone
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update table row or reload page
            alert(data.message);
            closeEditModal();
            location.reload(); // Reload the page to see the updated details
        } else {
            // Handle error
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});



		$(document).ready(function() {

                      


			var table = $('#employees').DataTable({
					responsive: true
                    
				})
				.columns.adjust()
				.responsive.recalc();

  
		});


    function exportTableToExcel() {
    const fileName = `employees.xlsx`;
    const table = document.getElementById('employees');

    // Clone the table and remove elements with id 'no-jobs'
    const clone = table.cloneNode(true);

    const wb = XLSX.utils.table_to_book(clone);

    XLSX.writeFile(wb, fileName);
    }
	</script>

</x-app-layout>

