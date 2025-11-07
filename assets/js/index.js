$(document).ready(function() {

  // Show modal when Add Member button is clicked
  $("#addMemberBtn").click(function() {
    $("#exampleModal").modal('show'); // Bootstrap modal
  });

  // Optional: close modal using a button (if you have one)
  $("#closemyModal").click(function() {
    $("#exampleModal").modal('hide');
  });

  // Handle form submission
  $("#addForm").on("submit", function(e) {
    e.preventDefault(); // prevent default form submission

    const name = $("#name").val().trim();
    if (name === "" || !/^[a-zA-Z\s]+$/.test(name)) {
      alert("Please enter a valid name (letters only).");
      return;
    }

    $.ajax({
      url: "ajax/add_member.php",
      method: "POST",
      data: $(this).serialize(),
      success: function(res) {
        const data = JSON.parse(res);

        if (data.status === "success") {
          const parentId = $("#parent_id").val();

          if (parentId === "") {
            if ($("#tree > ul").length === 0) $("#tree").append("<ul></ul>");
            $("#tree > ul").append("<li data-id='" + data.id + "'>" + data.name + "</li>");
          } else {
            let parentLi = $("li[data-id='" + parentId + "']");
            if (parentLi.children("ul").length === 0) parentLi.append("<ul></ul>");
            parentLi.children("ul").append("<li data-id='" + data.id + "'>" + data.name + "</li>");
          }

          // Add the new member to the parent dropdown dynamically
          $("#parent_id").append(
              $("<option></option>").val(data.id).text(data.name)
          );

          // Hide modal and reset form
          $("#exampleModal").modal('hide');
          $("#addForm")[0].reset();
        } else {
          alert("Error adding member.");
        }
      },
      error: function(xhr, status, error) {
        alert("AJAX Error: " + error);
      }
    });
  });

  
});
