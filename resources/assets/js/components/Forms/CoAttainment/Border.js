import React from "react";

const ButtonGroup = (props) => {
  return (
    <div className="flex-right" {...props} />
  );
}

const BorderAround = (props) => {
  return (
    <div className="border-around" 
      {...props} />
  );
}

const MainText = (props) => {
  return (
    <div className="flex-left">
      <span 
        style={{color: "rgba(45, 68, 148, 0.88)"}}>
        { props.children }
      </span>  
    </div>
  );
}

export {ButtonGroup, BorderAround, MainText };