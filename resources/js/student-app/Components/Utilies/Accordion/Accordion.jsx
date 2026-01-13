import React from "react";

const Accordion = ({ id, items, renderHeader, renderBody, defaultOpenIndex = 0, accordionHeadingStyle = {} }) => {
  return (
    <div className="accordion" id={id}>
      {items.map((item, index) => {
        const headingId = `${id}-heading-${item.id}`;
        const collapseId = `${id}-collapse-${item.id}`;
        const isOpen = index === defaultOpenIndex;

        return (
          <div className="accordion-item" key={item.id}>
            <h5 className="accordion-header" id={headingId} style={accordionHeadingStyle}>
              <button
                className={`accordion-button ${!isOpen ? "collapsed" : ""}`}
                type="button"
                data-bs-toggle="collapse"
                data-bs-target={`#${collapseId}`}
                aria-expanded={isOpen}
                aria-controls={collapseId}
              >
                {renderHeader(item)}
              </button>
            </h5>

            <div
              id={collapseId}
              className={`accordion-collapse collapse ${isOpen ? "show" : ""}`}
              aria-labelledby={headingId}
              data-bs-parent={`#${id}`}
            >
              <div className="accordion-body pl-4">
                {renderBody(item)}
              </div>
            </div>
          </div>
        );
      })}
    </div>
  );
};

export default Accordion;
