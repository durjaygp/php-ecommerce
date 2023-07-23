<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>React Form with PHP and MySQLi</title>
  <!-- React CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/react/17.0.2/umd/react.development.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/react-dom/17.0.2/umd/react-dom.development.js"></script>
  <!-- Babel CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.min.js"></script>
  <!-- Bootstrap CDN (optional for styling) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
    <style>
        body {
            background-image: url('bgimage/22.avif');
            background-size: cover;
            background-repeat: no-repeat;
        }
        .bg-primary {
            background: #70c745cf !important;
        }
    </style>
<body>
  <div id="root"></div>

  <script type="text/babel">
    // React component starts here
    const { useState } = React;

    const RegistrationForm = () => {
      const [formData, setFormData] = useState({
        name: '',
        email: '',
        phone: '',
        password: '',
      });

      const [formErrors, setFormErrors] = useState({
        name: '',
        email: '',
        phone: '',
        password: '',
      });

      const validateName = (name) => {
        const nameRegex = /^[a-zA-Z]+$/;
        return nameRegex.test(name);
      };

      const validateEmail = (email) => {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
      };

      const validatePhone = (phone) => {
        const phoneRegex = /^[0-9]+$/;
        return phoneRegex.test(phone);
      };

      const validatePassword = (password) => {
        return password.length >= 6;
      };

      const handleInputChange = (event) => {
        const { name, value } = event.target;
        setFormData({
          ...formData,
          [name]: value,
        });

        const errors = { ...formErrors };
        switch (name) {
          case 'name':
            errors.name = validateName(value) ? '' : 'Name should only contain letters.';
            break;
          case 'email':
            errors.email = validateEmail(value) ? '' : 'Please enter a valid email address.';
            break;
          case 'phone':
            errors.phone = validatePhone(value) ? '' : 'Phone should only contain numbers.';
            break;
          case 'password':
            errors.password = validatePassword(value) ? '' : 'Password should be at least 6 characters long.';
            break;
          default:
            break;
        }
        setFormErrors(errors);
      };

      const handleSubmit = (event) => {
        event.preventDefault();
        const formDataJson = JSON.stringify(formData);

        // Send form data to the server using fetch or XMLHttpRequest
        fetch('submit_form.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: formDataJson,
        })
        .then(response => response.text())
        .then(message => {
          alert(message);
          setFormData({
            name: '',
            email: '',
            phone: '',
            password: '',
          });
          setFormErrors({
            name: '',
            email: '',
            phone: '',
            password: '',
          });
        })
        .catch(error => console.error('Error:', error));
      };

      return (

              <div className="container">
                <div className="row">
                  <div className="col-md-6 py-5 bg-primary text-white text-center ">
                    <div className=" ">
                      <div className="card-body">
                        <img src="http://www.ansonika.com/mavia/img/registration_bg.svg"/>
                        <h6 className="py-3">Garden Company Registration Form</h6>
                        <p>The Garden Company website registration page is where users can create an account and gain
                          access to a variety of features, including the ability to purchase products, save their favorite
                          items. </p>
                      </div>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <form onSubmit={handleSubmit} className="container mt-4">
                      <div className="mb-3">
                        <label htmlFor="name" className="form-label">Name:</label>
                        <input
                                type="text"
                                id="name"
                                name="name"
                                value={formData.name}
                                onChange={handleInputChange}
                                className={`form-control ${formErrors.name ? 'is-invalid' : ''}`}
                        />
                        {formErrors.name && <div className="invalid-feedback">{formErrors.name}</div>}
                      </div>

                      <div className="mb-3">
                        <label htmlFor="email" className="form-label">Email:</label>
                        <input
                                type="text"
                                id="email"
                                name="email"
                                value={formData.email}
                                onChange={handleInputChange}
                                className={`form-control ${formErrors.email ? 'is-invalid' : ''}`}
                        />
                        {formErrors.email && <div className="invalid-feedback">{formErrors.email}</div>}
                      </div>

                      <div className="mb-3">
                        <label htmlFor="phone" className="form-label">Phone:</label>
                        <input
                                type="text"
                                id="phone"
                                name="phone"
                                value={formData.phone}
                                onChange={handleInputChange}
                                className={`form-control ${formErrors.phone ? 'is-invalid' : ''}`}
                        />
                        {formErrors.phone && <div className="invalid-feedback">{formErrors.phone}</div>}
                      </div>

                      <div className="mb-3">
                        <label htmlFor="password" className="form-label">Password:</label>
                        <input
                                type="password"
                                id="password"
                                name="password"
                                value={formData.password}
                                onChange={handleInputChange}
                                className={`form-control ${formErrors.password ? 'is-invalid' : ''}`}
                        />
                        {formErrors.password && <div className="invalid-feedback">{formErrors.password}</div>}
                      </div>

                      <button type="submit" className="btn btn-primary">Submit</button>
                    </form>
                  </div>
                </div>
              </div>
      );
    };

    // Render the component
    ReactDOM.render(<RegistrationForm />, document.getElementById('root'));
  </script>
</body>
</html>