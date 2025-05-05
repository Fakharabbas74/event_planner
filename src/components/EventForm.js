// src/components/EventForm.js
import React, { useState, useEffect } from 'react';

const EventForm = ({ onSubmit, initialData = {}, onCancel }) => {
  const [name, setName] = useState(initialData.name || '');
  const [detail, setDetail] = useState(initialData.detail || '');
  const [category, setCategory] = useState(initialData.detail || '');
  const [startDate, setStartDate] = useState(initialData.start_date || '');
  const [endDate, setEndDate] = useState(initialData.end_date || '');

  useEffect(() => {
    setName(initialData.name || '');
    setDetail(initialData.detail || '');
    setCategory(initialData.category || '');
    setStartDate(initialData.start_date || '');
    setEndDate(initialData.end_date || '');
  }, []);

  const handleSubmit = (e) => {
    e.preventDefault();
    onSubmit({
      name,
      detail,
      category,
      start_date: startDate,
      end_date: endDate,
    });
  };

  return (
    <form onSubmit={handleSubmit} className="event-form">
      <h2>{initialData?.id ? 'Edit Event' : 'Add Event'}</h2>

      <input
        type="text"
        placeholder="Event Name"
        value={name}
        onChange={(e) => setName(e.target.value)}
        required
      />

      <textarea
        placeholder="Event Detail"
        value={detail}
        onChange={(e) => setDetail(e.target.value)}
        required
      />

        <textarea
            placeholder="Event Category"
            value={category}
            onChange={(e) => setCategory(e.target.value)}
            required
        />

      <input
        type="date"
        value={startDate}
        onChange={(e) => setStartDate(e.target.value)}
        required
      />

      <input
        type="date"
        value={endDate}
        onChange={(e) => setEndDate(e.target.value)}
        required
      />

      <div className="form-actions">
        <button type="submit">{initialData?.id ? 'Update' : 'Create'}</button>
        <button type="button" onClick={onCancel} className="cancel-button">
          Cancel
        </button>
      </div>
    </form>
  );
};

export default EventForm;
