$(function(){
    getAllEmployee();
})


 function addNewMasterEmployee(){
     let employee_name = $("#employee_name").val(),
        employee_phone = $("#employee_phone").val(),
        employee_age = $("#employee_age").val(),
        employee_address = $("#employee_address").val(),
        employee_doj= $("#employee_doj").val(),
        employee_salary = $("#employee_salary").val();

        axios.post('/add-new-master-employee', {employee_name, employee_phone, employee_age, employee_address, employee_doj, employee_salary})
        .then(res=>{ 
            console.log(res);
            employee_name = $("#employee_name").val(" "),
            employee_phone = $("#employee_phone").val(" "),
            employee_age = $("#employee_age").val(" "),
            employee_address = $("#employee_address").val(" "),
            employee_doj= $("#employee_doj").val(" "),
            employee_salary = $("#employee_salary").val(" ");
            getAllEmployee();
            $("#myModal").modal('hide');

        })
        .catch(res=>{

        })

}

function editEmployee(id){
    
    axios.post('get-employee', {id})
    .then(res=>{
        
            $("#edit_id").val(res.data.data.id),
            $("#edit_name").val(res.data.data.employee_name),
            $("#edit_phone").val(res.data.data.employee_phone),
            $("#edit_age").val(res.data.data.employee_age),
            $("#edit_address").val(res.data.datainfo.address),
            $("#edit_doj").val(res.data.datainfo.doj),
            $("#edit_salary").val(res.data.datainfo.salary);
            $("#myEditModal").modal('show');
    
         }).catch(res=>{

    })

}

function updateEmployee(){
    let employee_id = $("#edit_id").val(),
        employee_name = $("#edit_name").val(),
        employee_phone = $("#edit_phone").val(),
        employee_age = $("#edit_age").val(),
        employee_address = $("#edit_address").val(),
        employee_doj= $("#edit_doj").val(),
        employee_salary = $("#edit_salary").val();
        

        axios.post('add-edit-employee', {employee_address, employee_salary, employee_age, employee_id, employee_name, employee_phone, employee_doj})
        .then(res=>{
            
            console.log(res);
            getAllEmployee();
            $("#myEditModal").modal('hide');
        })
        .catch(res=>{

        })
}

function deleteEmployee(id){
    
    axios.post('/delete-employee', {id})
    .then(res => {
        getAllEmployee();

   })
   .catch(err => {
     
   })
}

function getAllEmployee(){
    let tableData = "";
    let a = 1;
    axios.get('fetch-employee-table')
    .then(res=>{
        var authid = res.data.authid;
        //alert(authid);
        if(res.data.data.length > 0 ){
            res.data.data.forEach(employee =>{
                
                tableData += 
                `<tr>
                <td>${a++}</td>
                <td>${employee.emp_id}</td>
                <td>${employee.employee_name}</td>
                <td>${employee.employee_phone}</td>
                <td>${employee.employee_age}</td>
                <td>${employee.address}</td>
                <td>${employee.doj}</td>
                <td>${employee.salary}</td>
                <td>${employee.name}</td>
                <td>
                <a type="button" class="btn btn-success" onclick="editEmployee(${ employee.id })">Edit</a>`;

                if(res.data.authid == employee.employee_created_by){

                    tableData += `<a type="button" class="btn btn-danger but" onclick="deleteEmployee( ${ employee.id })">Delete</a>`;
                }

                tableData += `</td>
                </tr>`;
                
            })
            $("#employeeTable tbody").html(tableData)
        }


    })
    .catch(res=>{

    })
    

}