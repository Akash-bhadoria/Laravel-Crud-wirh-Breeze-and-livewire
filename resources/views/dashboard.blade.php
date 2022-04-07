@include('../employee/layout')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        
    </x-slot>

    <!--modal for employee master-->

    <div class="container mt-3">
      {{-- <livewire:counter /> --}}

      
      <a class="btn btn-primary" href="{{ route('wire')}}" role="button">LIve Wire</a>
        <button type="button"  class="btn btn but "  data-bs-toggle="modal" data-bs-target="#myModal">
        Add Employee
        </button>
      </div>
      
      <!-- The Modal -->
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Add Employee Details</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container mt-3">
                    <form>
                      <div class="mb-3 mt-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="employee_name" placeholder="Enter Name" name="employee_name">
                      </div>
                      <div class="mb-3">
                        <label for="phone">Phone No:</label>
                        <input type="tel" class="form-control" id="employee_phone" placeholder="Enter Phone No" name="employee_phone" >
                      </div>
                      <div class="mb-3">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="employee_age" placeholder="Enter Age" name="employee_age" size="4" min="18" >
                      </div>
                      <div class="mb-3">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="employee_address" placeholder="Enter Address" name="employee_address">
                      </div>
                      <div class="mb-3">
                        <label for="doj">Date Of Joining:</label>
                        <input type="date" class="form-control" id="employee_doj" placeholder="" name="employee_doj">
                      </div>
                      <div class="mb-3">
                        <label for="salary">Salary:</label>
                        <input type="number" class="form-control" id="employee_salary" placeholder="Enter Salary" name="employee_salary">
                      </div>
                      <button type="submit" style="color:black;box-shadow: 0 0 0 0.10rem green;" class="btn btn" onclick="addNewMasterEmployee()">Add Employee Master</button>
                    </form>
                  </div>
            </div>
      
            <!-- Modal footer -->
            
      
          </div>
        </div>
      </div>


      <div class="modal" id="myEditModal">
        <div class="modal-dialog">
          <div class="modal-content">
      
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Edit Employee Details</h4>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
      
            <!-- Modal body -->
            <div class="modal-body">
                <div class="container mt-3">
                    <form>
                      <div class="mb-3 mt-3">
                        <input type="hidden" name="employee_id" id="edit_id">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="edit_name" placeholder="Enter Name" name="employee_name">
                      </div>
                      <div class="mb-3">
                        <label for="phone">Phone No:</label>
                        <input type="tel" class="form-control" id="edit_phone" placeholder="Enter Phone No" name="employee_phone" >
                      </div>
                      <div class="mb-3">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="edit_age" placeholder="Enter Age" name="employee_age" size="4" min="18" >
                      </div>
                      <div class="mb-3">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" id="edit_address" placeholder="Enter Address" name="employee_address">
                      </div>
                      <div class="mb-3">
                        <label for="doj">Date Of Joining:</label>
                        <input type="date" class="form-control" id="edit_doj" placeholder="" name="employee_doj">
                      </div>
                      <div class="mb-3">
                        <label for="salary">Salary:</label>
                        <input type="number" class="form-control" id="edit_salary" placeholder="Enter Salary" name="employee_salary">
                      </div>
                      <button type="submit" style="color:black;box-shadow: 0 0 0 0.10rem green;" class="btn btn" onclick="updateEmployee()">Update</button>
                    </form>
                  </div>
            </div>
      
            <!-- Modal footer -->
            
      
          </div>
        </div>
      </div>



      <!--END modal for employee master-->

<br><hr><br>

      <!-- Tables for showing data-->

      <div class="container ">          
        <table class="table table-bordered" id="employeeTable">
          <thead>
            <tr>
              <th>S.No</th>
              <th>Emp Id</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Age</th>
              <th>Address</th>
              <th>Date of Joining</th>
              <th>Salary</th>
              <th>Created By</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($fetchs as $fetch)
            <tr>
              <td>{{++$loop->index}}</td>
              <td>{{$fetch->emp_id}}</td>
              <td>{{$fetch->employee_name}}</td>
              <td>{{$fetch->employee_phone}}</td>
              <td>{{$fetch->employee_age}}</td>
              <td>{{$fetch->address}}</td>
              <td>{{$fetch->doj}}</td>
              <td>{{$fetch->salary}}</td>
              <td>{{$fetch->name}}</td>
              <td>
                <a type="button" class="btn btn-success but" onclick="editEmployee({{ $fetch->id }})">Edit</a>
                @if (Auth::id() == $fetch->employee_created_by)
                <a type="button" class="btn btn-danger but" onclick="deleteEmployee({{ $fetch->id }})">Delete</a>
                @endif
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      

   
</x-app-layout>


