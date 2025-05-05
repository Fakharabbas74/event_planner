// src/pages/Admin.js
import React, { useEffect, useState } from 'react';
import API from '../api/api';
import { toast, ToastContainer } from 'react-toastify';
import EventForm from '../components/EventForm';
import 'react-toastify/dist/ReactToastify.css';
import '../styles/Admin.css';
import { MdEdit, MdDelete } from 'react-icons/md';

const Admin = () => {
  const [events, setEvents] = useState([]);
  const [editingEvent, setEditingEvent] = useState(null);
  const [showForm, setShowForm] = useState(false);
  const [isLoading, setIsLoading] = useState(true); // corrected typo

  const token = localStorage.getItem('token');

  const fetchEvents = async () => {
    setIsLoading(true); // Start loading
    try {
      const response = await API.get('/get-all-events', {
        headers: { Authorization: `Bearer ${token}` },
      });
      setEvents(response.data.data);
    } catch (error) {
      toast.error('Failed to fetch events.');
      console.error(error);
    }
    setIsLoading(false); // Stop loading
  };

  useEffect(() => {
    fetchEvents();
  }, [showForm]);

  const handleCreate = async (eventData) => {
    try {
      await API.post('/create-event', eventData, {
        headers: { Authorization: `Bearer ${token}` },
      });
      toast.success('Event created successfully.');
      fetchEvents();
      setShowForm(false);
    } catch (error) {
      toast.error('Failed to create event.');
      console.error(error);
    }
  };

  const handleUpdate = async (eventData) => {
    try {
      await API.put(`/edit-event/${editingEvent.id}`, eventData, {
        headers: { Authorization: `Bearer ${token}` },
      });
      toast.success('Event updated successfully.');
      fetchEvents();
      setEditingEvent(undefined);
      setShowForm(false);
    } catch (error) {
      toast.error('Failed to update event.');
      console.error(error);
    }
  };

  const handleDelete = async (id) => {
    if (window.confirm('Are you sure you want to delete this event?')) {
      try {
        await API.delete(`/delete-event/${id}`, {
          headers: { Authorization: `Bearer ${token}` },
        });
        toast.success('Event deleted successfully.');
        fetchEvents();
      } catch (error) {
        toast.error('Failed to delete event.');
        console.error(error);
      }
    }
  };

  const handleEdit = (event) => {
    setEditingEvent(event);
    setShowForm(true);
  };

  const handleCancel = () => {
    setEditingEvent(null);
    setShowForm(false);
  };

  return (
    <div className="admin-container">
      <ToastContainer />
      <h1>Event Management</h1>

      {showForm ? (
        <EventForm
          onSubmit={editingEvent ? handleUpdate : handleCreate}
          initialData={editingEvent}
          onCancel={handleCancel}
        />
      ) : (
        <button
          onClick={() => {
            setEditingEvent(undefined);
            setShowForm(true);
          }}
          className="add-event-button"
        >
          Add New Event
        </button>
      )}

{isLoading ? (
  <div className="loader-spinner"></div>
) : (
  <table className="events-table">
  <thead>
    <tr>
      <th>Sr.</th> 
      <th>Name</th>
      <th>Detail</th>
      <th>Category</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    {events.length !== 0 &&
      events.map((event, index) => (
        <tr key={event.id}>
          <td>{index + 1}</td> 
          <td>{event.name}</td>
          <td>{event.detail}</td>
          <td>{event.category}</td>
          <td>{event.start_date}</td>
          <td>{event.end_date}</td>
          <td>
            <button
              onClick={() => handleEdit(event)}
              className="icon-button edit-button"
              title="Edit"
            >
              <MdEdit />
            </button>
            <button
              onClick={() => handleDelete(event.id)}
              className="icon-button delete-button"
              title="Delete"
            >
              <MdDelete />
            </button>
          </td>
        </tr>
      ))}
  </tbody>
</table>

      )}
    </div>
  );
};

export default Admin;
