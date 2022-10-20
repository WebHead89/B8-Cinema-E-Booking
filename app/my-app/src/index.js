import { BrowserRouter, Route, Routes } from "react-router-dom";
import BookingPage from "./pages/BookingPage/BookingPage";
import App from './App'
import React from 'react';
import ReactDOM from 'react-dom/client';

const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(

  <BrowserRouter>
    <Routes>
      <Route path="/" element={<App/>}/>
      <Route path="/booking" element={<BookingPage/>} />
    </Routes>
  </BrowserRouter>

);