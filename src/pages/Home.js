import React, { useEffect, useState } from 'react';
import API from '../api/api';
import '../styles/Home.css';

const Home = () => {
  const [events, setEvents] = useState([]);

  useEffect(() => {
    const fetchEvents = async () => {
      try {
        const response = await API.get('/get-all-events');
        setEvents(response.data.data);
      } catch (error) {
        console.error('Error fetching events:', error);
      }
    };

    fetchEvents();
  }, []);

  return (
    <div className="home-container">
      <header className="navbar">

        <h2 className="logo">EventPlanner</h2>
      </header>
  
      <main className="main-content">
        <div className="content-wrapper">
          <h1 className="main-heading">All Upcoming Events</h1>
          <p className="sub-heading">Explore hand-picked events happening soon</p>
  
          <section className="event-grid">
            {events.map((event) => (
              <div className="event-card" key={event.id}>
              {/* Header Banner */}
              <div className="event-header">
                <i className="fas fa-calendar-alt"></i>
                <h3>{event.name || "Untitled Event"}</h3>
              </div>
            
              {/* Category */}
              <div className="event-category">
                <i className="fas fa-tag"></i> 
                <strong>Category:</strong> {event.category || "N/A"}
              </div>
            
              {/* Description */}
              <div className="event-description">
                <i className="fas fa-info-circle"></i>
                <span>{event.detail || "No description provided."}</span>
              </div>
            
              {/* Date Range */}
              <div className="event-dates">
                <div>
                  <i className="fas fa-play-circle"></i> <strong>From:</strong> {event.start_date}
                </div>
                <div>
                  <i className="fas fa-stop-circle"></i> <strong>To:</strong> {event.end_date}
                </div>
              </div>
            </div>
            
            ))}
          </section>
        </div>
      </main>
  
      <footer className="footer">
        <p>© 2025 EventPlanner. All rights reserved.</p>
      </footer>
    </div>
  );
  
};

export default Home;
