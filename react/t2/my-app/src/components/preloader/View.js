import React, {useState, useEffect} from 'react';

export default function Preloader(props){
  const [show, setShow] = useState(props.preloader);

  useEffect(() => {
    if(!props.preloader){
      setTimeout(() => {
        setShow(false)
      }, 4000)
    }    
  }, [props.preloader])  

  return (
    <React.Fragment>
      {show && (
        <div className={`preloader ${props.preloader ? '' : 'preloader-hide'}`}>
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
            <circle cx="50" cy="50" fill="none" stroke="#0a0a0a" strokeWidth="10" r="35" strokeDasharray="164.93361431346415 56.97787143782138">
              <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
            </circle>
          </svg>
        </div>
      )}
    </React.Fragment>
  )
}