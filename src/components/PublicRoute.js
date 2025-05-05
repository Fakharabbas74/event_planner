// src/components/PublicRoute.js
import React from 'react';
import { Navigate } from 'react-router-dom';

const PublicRoute = ({ children }) => {
  let user = null;

  try {
    const storedUser = localStorage.getItem('user');
    user = storedUser ? JSON.parse(storedUser) : null;
  } catch (e) {
    user = null;
  }

  if (user && user.role === 'admin') {
    return <Navigate to="/admin" replace />;
  }

  return children;
};

export default PublicRoute;
