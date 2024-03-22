<div class="container-identity-verifyDID">
    <div>
        <label for="verifyDID_data" class="input-label-verifyDID">Data</label>
        <input type="text" id="verifyDID_data" class="input-verifyDID" placeholder="DID to be verified" required>
    </div>
    <div>
        <label for="verifyDID_verified" class="input-label-verifyDID">Verified</label>
        <input type="text" id="verifyDID_verified" class="input-verifyData" disabled>
    </div>
    <button class="btn-identity-verifyDID" id="verifyDID" onclick="verifyDID()">
        Verify data
    </button>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script type="text/javascript">

        function verifyDID() {
            let rawdata = document.getElementById('verifyDID_data').value;
            window.IAMX.verifyDID(rawdata);
        }

        window.addEventListener("message", function (event) {
                if (event.data.type === "FROM_IAMX") {
                    console.log(event.data.msg);
                    if (event.data.msg === "verifyDDID") {
                        document.getElementById('verifyDID_verified').value = event.data.data['verified']
                    }
                }
            }
        );

    </script>
</div>
