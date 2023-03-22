flag = 0;
function validate() {
    var phone = document.getElementById('exampleInputPhone').value;
    var email = document.getElementById('exampleInputEmail1').value;
    var first_name = document.getElementById('exampleInputFName').value;
    var second_name = document.getElementById('exampleInputLName').value;
    var department = document.getElementById('exampleInputDepartment').value;
    var phone_error = document.getElementById('phone_error');
    var email_error = document.getElementById('email_error');
    var dpt_error = document.getElementById('dpt_error');
    var first_name_error = document.getElementById('fname_error');
    var second_name_error = document.getElementById('lname_error');
    var main_error = document.getElementById('main_error');
  
    var isValid = true;
  
    if (first_name === '') {
      first_name_error.innerHTML = 'Please enter your first name';
      first_name_error.style.color = 'red';
      isValid = false;
    } else if (first_name.length < 4) {
      first_name_error.innerHTML = 'First name should have at least 2 characters';
      first_name_error.style.color = 'red';
      isValid = false;
    } else {
      first_name_error.innerHTML = '';
    }
  
    // Check second name
    if (second_name === '') {
      second_name_error.innerHTML = 'Please enter your second name';
      second_name_error.style.color = 'red';
      isValid = false;
    } else if (second_name.length < 1) {
      second_name_error.innerHTML = 'Second name should have at least 1 character';
      second_name_error.style.color = 'red';
      isValid = false;
    } else {
      second_name_error.innerHTML = '';
    }
  
  
    // Check phone number
    if (phone === '') {
      phone_error.innerHTML = 'Please enter your phone number';
      phone_error.style.color = 'red';
      isValid = false;
    } else if (!/^\d{10}$/.test(phone)) {
      phone_error.innerHTML = 'Phone number should be 10 digits';
      phone_error.style.color = 'red';
      isValid = false;
    } else {
      phone_error.innerHTML = '';
    }
  
    // Check email
    if (email === '') {
      email_error.innerHTML = 'Please fill in your email';
      email_error.style.color = 'red';
      isValid = false;
    } else if (!/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/.test(email)) {
      email_error.innerHTML = 'Email should be in a valid format';
      email_error.style.color = 'red';
      isValid = false;
    } else {
      email_error.innerHTML = '';
    }

    if (department === '') {
        dpt_error.innerHTML = 'Please enter your department';
        dpt_error.style.color = 'red';
        isValid = false;
      } else {
        dpt_error.innerHTML = '';
      }
  
    if (isValid) {
      document.getElementById('submit').disabled = false;
    }
    else{
      document.getElementById('submit').disabled = true;
    }
  }