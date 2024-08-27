$(document).ready(function () {
    var csrfToken = Cookies.get("token");

    // Get all requests
    function getAllRequests() {
        $.ajax({
            url: `http://127.0.0.1:8000/api/requests`,
            method: "GET",
            dataType: "json",
            success: function (data) {
                // Handle the response data
                console.log(data);
            },
            error: function () {
                console.error("An error occurred while fetching all requests.");
            },
        });
    }

    // Get a specific request by ID
    function getRequestById(id) {
        $.ajax({
            url: `http://127.0.0.1:8000/api/requests/${id}`,
            method: "GET",
            dataType: "json",
            success: function (data) {
                // Handle the response data
                console.log(data);
            },
            error: function () {
                console.error(`An error occurred while fetching request with ID ${id}.`);
            },
        });
    }

    // Create a new request
    function createRequest(requestData) {
        $.ajax({
            url: `http://127.0.0.1:8000/api/requests`,
            method: "POST",
            data: requestData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // Handle the response data
                console.log(response);
            },
            error: function (xhr) {
                console.error("An error occurred while creating the request:", xhr.responseText);
            },
        });
    }

    // Update an existing request
    function updateRequest(requestData) {
        $.ajax({
            url: `http://127.0.0.1:8000/api/requests`,
            method: "PUT",
            data: requestData,
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // Handle the response data
                console.log(response);
            },
            error: function (xhr) {
                console.error("An error occurred while updating the request:", xhr.responseText);
            },
        });
    }

    // Delete a request by ID
    function deleteRequest(id) {
        $.ajax({
            url: `http://127.0.0.1:8000/api/requests/${id}`,
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            success: function (response) {
                // Handle the response data
                console.log(response);
            },
            error: function () {
                console.error(`An error occurred while deleting request with ID ${id}.`);
            },
        });
    }

    // Example usage
    getAllRequests();
    getRequestById(1);
    createRequest({
        type: "example",
        employee_id: 123,
        details: "Example details",
    });
    updateRequest({
        id: 1,
        type: "updated example",
        details: "Updated details",
    });
    deleteRequest(1);
});
