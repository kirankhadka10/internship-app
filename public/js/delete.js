

    
        function confirmDelete(id) {
            if(confirm("Are you sure you want to delete ?")) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    
    
