// Import necessary modules
import styled from "@emotion/styled"; // Styled components library for styling
import "./styles.css"; // Importing custom CSS styles
import React from "react"; // Importing React for creating components

// Header component styled using Emotion
const Header = styled.header`
  padding: 32px; // Adds padding around the header
  background-color: hotpink; // Sets the background color of the header
  font-size: 24px; // Font size for the text in the header
  border-radius: 4px; // Rounded corners for the header
  color: black; // Text color inside the header
  font-weight: bold; // Make text bold
  &:hover { // When the header is hovered over
    color: white; // Change text color to white when hovered
  }
`;

// TitleView component styled with dynamic props (spacing and minCellWidth)
const TitleView = styled.div`
  display: grid; // Using grid layout
  padding: ${(props) => props.spacing}px; // Dynamic padding based on 'spacing' prop
  gap: ${(props) => props.spacing}px; // Gap between grid items
  grid-template-columns: repeat(
    auto-fill,
    minmax(${(props) => props.minCellWidth}px, 1fr)
  ); // Define grid columns with dynamic min-width based on 'minCellWidth' prop
`;

// Frame component styled for a fullscreen overlay
const Frame = styled.div`
  position: fixed; // Fixed positioning
  top: 0; // Align to the top of the screen
  right: 0; // Align to the right of the screen
  left: 0; // Align to the left of the screen
  bottom: 0; // Align to the bottom of the screen
  background-color: hsla(0, 0%, 100%, 0.96); // Semi-transparent white background
  z-index: 5; // Display it above other elements
`;

// Setting default values for TitleView component props
TitleView.defaultProps = {
  spacing: 16, // Default spacing value
  minCellWidth: 120, // Default minimum cell width for grid items
};

// Style for thumbnails (small image preview)
const thumbnailStyles = {
  display: "block", // Make images display as block elements
  width: "100%", // Make images fill the width of their container
  objectFit: "cover", // Ensure the image covers the container without distortion
  cursor: "zoom-in", // Change cursor to zoom-in on hover
};

// Style for the fullscreen image view
const fullscreenStyles = {
  position: "fixed", // Fixed positioning for fullscreen image
  top: 0, // Align to the top of the screen
  right: 0, // Align to the right of the screen
  left: 0, // Align to the left of the screen
  bottom: 0, // Align to the bottom of the screen
  width: "80vw", // Set width to 80% of the viewport width
  margin: "auto", // Center the image
  zIndex: 10, // Ensure it's displayed above other content
  cursor: "zoom-out", // Change cursor to zoom-out on hover
};

// Main component that fetches images from the API and handles display logic
class TestAPI extends React.Component {
  // Initial state with an empty array of images and no active photo
  state = {
    images: [],
    currentPhotoId: null,
  };

  // Fetch images when the component mounts
  componentDidMount() {
    fetch("https://picsum.photos/list") // Fetching image list from Picsum API
      .then((response) => response.json()) // Parse response as JSON
      .then((data) => {
        // Update state with the first 30 images
        this.setState({
          images: data.slice(0, 30),
        });
      });
  }

  // Render the component
  render() {
    return (
      <div>
        {/* Header component displaying title */}
        <Header>
          <h1> Picsum </h1> {/* Displaying the title "Picsum" */}
        </Header>
        
        // TitleView component with spacing and minimum cell width
<TitleView spacing={60} minCellWidth={120}>
  {
    // Iterate over each image in the state
    this.state.images.map((image) => {
      // Determine if the current image is the active one based on the current photo ID
      const isActive = this.state.currentPhotoId === image.id;

      return (
        // Render a Photo component for each image with a unique key (image.id)
        <Photo
          key={image.id} // Assign a unique key for React rendering efficiency
          
          // Set the image source dynamically based on the image ID
          src={`https://picsum.photos/1000/1000?image=${image.id}`} // URL to fetch the image from picsum.photos using image.id
          
          // Pass the isActive state to the Photo component to track if this image is currently active
          isActive={isActive} // Boolean value indicating whether this image is active
          
          // Define the click behavior for each image
          onClick={() =>
            // When the image is clicked, toggle the active state
            this.setState({ currentPhotoId: isActive ? null : image.id })
            // If the image is already active, set currentPhotoId to null (deactivate it)
            // If the image is not active, set currentPhotoId to the image's ID (activate it)
          }
        />
      );
    })
  }
</TitleView>

        
        {/* Frame displayed when an image is active */}
        {this.state.currentPhotoId !== null && <Frame />} {/* Show frame when an image is selected */}
      </div>
    );
  }
}

// Main App component that renders TestAPI component
export default function App() {
  return (
    <div className="App">
      {/* Rendering the TestAPI component inside the header */}
      <header className="App-header">
        <TestAPI /> {/* Render the TestAPI component */}
      </header>
    </div>
  );
}

// Photo component styled based on whether it is active or not
export const Photo = styled("img")((props) =>
  props.isActive ? fullscreenStyles : thumbnailStyles // Apply different styles based on active state
);
