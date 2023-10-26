import React from "react";
import { useState } from "react";
import axios from "axios";
import { useEffect } from "react";
import {  BrowserRouter ,Link,Router,  Routes,  Route,Switch } from "react-router-dom";
import Candels from './Candels'
import  Search1  from "./Search1";
import  Search  from "./Search";

function FetchSearch()
{var [link,slink]=useState("GET STARTed")
        return(<>
        
         <div className="App">
      <nav className="navbar">
        <div className="navbar-brand">
          <a href="/">Logo</a>
        </div>
        <div className="navbar-menu">
          <div className="navbar-start">
            <a href="/" className="navbar-item">
              Home
            </a>
            <a href="/about" className="navbar-item">
              About
            </a>
            <a href="/contact" className="navbar-item">
              Contact
            </a>
          </div>
          <div className="navbar-end">
            <a href="/login" className="navbar-item">
              Login
            </a>
            <a href="/signup" className="navbar-item">
              Signup
            </a>
          </div>
        </div>
      </nav>
      <div className="content">
        {/* Your page content goes here */}
        <h1>Welcome to My Website</h1>
        {/* ... */}
      </div>
    </div>
     
        <a href="/home" onClick={(()=>{slink([""])})}>{link}</a>
        <Routes>
          <Route path="home" element={<Search1 />} />
      </Routes>
    
  

       </>)
       
    }
    export default FetchSearch