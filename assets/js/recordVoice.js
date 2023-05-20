    const audioPlayer = document.getElementById("audioPlayer");
    const recordButton = document.getElementById("recordButton");
    const stopButton = document.getElementById("stopButton");
    const uploadForm = document.getElementById("uploadForm");
    const audioFilenameInput = document.getElementById("audioFilename");
    const audioFileInput = document.getElementById("audioFile");
    const uploadButton = document.getElementById("uploadButton");

    recordButton.addEventListener("click", startRecording);
    stopButton.addEventListener("click", stopRecording);
    uploadButton.addEventListener("click", uploadAudio);

    let stream;
    let mediaRecorder;
    let chunks = [];

    function startRecording() {
      // Clear previous recording
      audioPlayer.src = "";
      chunks = [];

      navigator.mediaDevices
        .getUserMedia({ audio: true })
        .then((userMediaStream) => {
          stream = userMediaStream;
          mediaRecorder = new MediaRecorder(stream);

          mediaRecorder.addEventListener("dataavailable", (e) => {
            chunks.push(e.data);
          });

          mediaRecorder.addEventListener("stop", () => {
            const audioBlob = new Blob(chunks, { type: "audio/webm" });
            chunks = [];

            const audioUrl = URL.createObjectURL(audioBlob);
            audioPlayer.src = audioUrl;

            const timestamp = new Date().getTime();
            const filename = `recording_${timestamp}.webm`;
            audioFilenameInput.value = filename;

            uploadButton.disabled = false;
          });

          mediaRecorder.start();

          recordButton.disabled = true;
          stopButton.disabled = false;
        })
        .catch((error) => {
          console.error("Error accessing microphone:", error);
        });
    }

    function stopRecording() {
      if (mediaRecorder && mediaRecorder.state === "recording") {
        mediaRecorder.stop();
        stream.getTracks().forEach((track) => {
          track.stop();
        });

        recordButton.disabled = false;
        stopButton.disabled = true;
      }
    }

    function uploadAudio() {
      const formData = new FormData();
      formData.append("audioFilename", audioFilenameInput.value);
      formData.append("audioFile", audioFileInput.files[0]);

      fetch("../../view/patient/upload.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((result) => {
          console.log(result); // Handle the server response here
        })
        .catch((error) => {
          console.error("Error uploading audio:", error);
        });
    }