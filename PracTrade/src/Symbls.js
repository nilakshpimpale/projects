import React from "react";
import { useState } from "react";
import axios from "axios";
import { useEffect } from "react";
import {  BrowserRouter ,Link,Router,  Routes,  Route} from "react-router-dom";
import Candels from './Candels'
import  Search  from "./Search";
import Search1 from "./Search1"
import Symbls from './Symbls'
function funn(params) {
    
return(<>
<iframe src="https://datahub.io/core/nasdaq-listings/r/1.html" height="10000" width="1800" frameborder="0"></iframe>

     <Routes>
     <Route path="symbols" element={<Symbls />} />
          <Route path="candels" element={<Candels />} />  
          <Route path="search" element={<Search/>} />
          <Route path="candels" element={<Candels />} />
          
      </Routes>
</>)
}
export default funn;