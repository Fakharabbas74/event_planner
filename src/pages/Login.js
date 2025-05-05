import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { toast, ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import '../styles/Login.css';
import API from '../api/api';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();

    try {
      const response = await API.post(`/sign-in`, {
        email,
        password,
      });

      if(response.data.status){
        const user = response.data.user;
        const token = response.data.access_token;
        console.log(token);
        localStorage.setItem('user', JSON.stringify(user));
        localStorage.setItem('token', token);
        
        toast.success('Login successful!');
        // Redirect to admin
        setTimeout(() => {
          navigate('/admin');
        }, 1000);
      }else{
        toast.warning(response.data.message);
      }
    } catch (error) {
      toast.error(error.response?.data?.message || 'Login failed');
    }
  };

  return (
    <div className="login-container">
      <ToastContainer />
      <form className="login-form" onSubmit={handleLogin}>
        <h2>Admin Login</h2>
        <input
          type="email"
          placeholder="Email"
          required
          value={email}
          onChange={(e) => setEmail(e.target.value)}
        />
        <input
          type="password"
          placeholder="Password"
          required
          value={password}
          onChange={(e) => setPassword(e.target.value)}
        />
        <button type="submit">Login</button>
      </form>
    </div>
  );
};

export default Login;
