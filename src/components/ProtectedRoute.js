// src/components/ProtectedRoute.js
import React from 'react';
import { Navigate } from 'react-router-dom';

const ProtectedRoute = ({ children }) => {
  const user = JSON.parse(localStorage.getItem('user'));
  const token = localStorage.getItem('token');
  if (token || (user && user.role === 'admin')) {
    return children;
  }
  return <Navigate to="/login" replace />;
  
};
export default ProtectedRoute;
