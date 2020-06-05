import React, { useState, useEffect } from "react";
import Modal from "react-modal";

const customStyles = {
  content: {
    top: "50%",
    left: "50%",
    right: "auto",
    bottom: "auto",
    marginRight: "-50%",
    transform: "translate(-50%, -50%)",
    backgroundColor: "#ddd",
    width: "300px",
    display: "flex",
    justifyContent: "center",
    flex: 1,
  },
};

const CustomModalCreate = (props) => {
  const handleOpenModal = () => {
    props.openModal()
  };


  return (
    <div>
      <button className="button" onClick={handleOpenModal}>
        {props.button}
      </button>
      <Modal ariaHideApp={false} isOpen={props.isOpen} style={customStyles}>
        {props.children}
      </Modal>
    </div>
  );
};

export default CustomModalCreate;
