import React, { useState, useEffect } from "react";

const Pagination = ({ paginationData, onPageChange }) => {
    const [currentPage, setCurrentPage] = useState(paginationData.current_page);
    const [totalPages, setTotalPages] = useState(paginationData.last_page);

    // Handle page change
    const handlePageChange = (page) => {
        if (page === currentPage) return; // Don't fetch if the page is the same as the current page.

        setCurrentPage(page);
        onPageChange(page); // Call onPageChange to trigger an API fetch for the new page.
    };

    // Handle the Next and Previous page
    const handleNextPage = () => {
        if (paginationData.next_page_url) {
            setCurrentPage(currentPage + 1);
            onPageChange(currentPage + 1);
        }
    };

    const handlePrevPage = () => {
        if (paginationData.prev_page_url) {
            setCurrentPage(currentPage - 1);
            onPageChange(currentPage - 1);
        }
    };

    // Render the pagination
    return (
        <div className="block-27">
            <ul>
                <li className="mr-2">
                    <a
                        href="#"
                        onClick={(e) => {
                            e.preventDefault();
                            handlePrevPage();
                        }}
                    >
                        &lt;
                    </a>
                </li>

                {/* Display page numbers */}
                {[...Array(totalPages).keys()].map((pageIndex) => {
                    const page = pageIndex + 1;
                    return (
                        <li key={page} className={page === currentPage ? "active mr-2" : "mr-2"}>
                            <a
                                href="#"
                                onClick={(e) => {
                                    e.preventDefault();
                                    handlePageChange(page);
                                }}
                            >
                                {page}
                            </a>
                        </li>
                    );
                })}

                <li>
                    <a
                        href="#"
                        onClick={(e) => {
                            e.preventDefault();
                            handleNextPage();
                        }}
                    >
                        &gt;
                    </a>
                </li>
            </ul>
        </div>
    );
};

export default Pagination;
