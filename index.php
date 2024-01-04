<?php require_once('config.php'); ?>
<script>
let theShader;
let debug_div = document.querySelector('.debug-el');

const vertexShader = `
	// - - - .VERT FILE - - - 

	// This code is applied to every PIXEL.

	// THIS IS THE .VERT FILE. is used to place and position the pixel edits of the .frag file.

	// The .vert file indicates how each pixel in the shader should be colored.

	// - - - - - 

	// SETUP code

	// If GL_ES (Browser shader API) is deteced 
	#ifdef GL_ES

	// Indicate the precision of the shader
	// "highp" or "mediump" or "lowp"
	// float is the data type
	precision mediump float;
	#endif


	//"attribute" is calls the a global variable between the .vert and the OpenGLES environment. "vec3" indicates that the variable has 3 parameters (x, y, z). "aPosition" is a read-only variable defining the default position info of the shader. 

	attribute vec3 aPosition;


	varying vec3 vPos;


	// Shader coordinate system is opposite a p5 canvas. It starts in teh lower left corner (0.0, 0.0) and then goes to the upper right (1.0, 1.0). 
	// Everything is defined on a scale for 0-1.
	// So position x = 0, y = 0 or (0, 0) for a sketch, is position (0.0, 0.0) for the shader.
	// Position x = width, y = height or (width, height) for a sketch, is position (1.0, 1.0) for the shader.


	void main() {
		// For shaders in p5 we have to scale the position. Thi is how we do that.

		//Establish a vec4 which has 4 parameters. Take aPositon and add 1.0, the fourth vec4 postion parameter. (x,y,z,w). We aren't using z because we're operating in 2 diminsions. When w = 1.0 the vector is treated as a position. When w = 0.0 the vector is treated as a direction as is standard in vector math.
		// We want to move it to the center of the screen.
		vec4 positionVec4 = vec4(aPosition, 1.0);

		// Here we are scaling the pixel position by 2 (we have to use .0 syntax) to get it twice as big and then move it to the top left side by subtracting 1.
		positionVec4.xy = positionVec4.xy * 2.0 - 1.0;

		//this sends the shader position to the .frag file. This should be the last line in your .vert file.
		gl_Position = positionVec4;

		vPos = aPosition;
	}
`;


const fragementShader = `
	#ifdef GL_ES
		precision mediump float;
	#endif

	uniform vec2 uResolution;
	uniform float uTime;
	uniform vec2 uMpos;

	varying vec3 vPos;

	void main() {


		// float gradient_circle = distance(vPos.xy, vec2(uMpos.x, 1.0 - uMpos.y) );

		// float strength = 1.0 - step(abs(sin(uTime * 0.01) * 0.5), gradient_circle);

		float offsetX = sin(uTime * 0.01) * 50.0;
		float offsetY = sin(uTime * 0.01 + 1.0) * 50.0;

		float colorCyle = 1.0 - abs( sin(uTime * 0.01 + 5.0) ) + 0.25;

		vec2 waveUv = vec2(
			vPos.x + sin(vPos.y * offsetX ) * 0.1,
			vPos.y + sin(vPos.x * offsetY ) * 0.1
		);


		float strength = distance(waveUv.xy, vec2(uMpos.x, 1.0 - uMpos.y)) * 1.0;
		gl_FragColor = vec4(vPos.xy / strength * 0.5, colorCyle, 1.0);
	}
`;




function setup() {
	createCanvas(windowWidth, windowHeight, WEBGL);
	noStroke();
	background(0);
	
	theShader = createShader(vertexShader, fragementShader);
}

let mouse_coords = {
	x : 0,
	y : 0
}

let largest_dim = Math.max(window.innerWidth, window.innerHeight);



function draw() {
	mouse_coords.x = lerp(mouse_coords.x, mouseX, 0.075);
	mouse_coords.y = lerp(mouse_coords.y, mouseY, 0.075);
	theShader.setUniform('uResolution', [width, height]);
	theShader.setUniform('uTime', [frameCount]);
	theShader.setUniform('uMpos', [
		map(mouse_coords.x, 0, width, 0.0, 1.0), 
		map(mouse_coords.y, 0, height, 0.0, 1.0)
	])

	// mouse_coords.x = mouseX;
	// mouse_coords.y = mouseY;

	shader(theShader);
	// rectMode(CENTER

	// fill(255, 0, 255);
	rect(0, 0, width, height);
}

function windowResized() {
	resizeCanvas(windowWidth, windowHeight);
	largest_dim = Math.max(window.innerWidth, window.innerHeight);
}</script>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<?php if($_settings->chk_flashdata('success')): ?>
<script>
  $(function(){
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
  })
</script>
<?php endif;?>
<body>
<?php require_once('inc/topBarNav.php') ?>
<?php $page = isset($_GET['p']) ? $_GET['p'] : 'home';  ?>
<?php 
    if(!file_exists($page.".php") && !is_dir($page)){
        include '404.html';
    }else{
    if(is_dir($page))
        include $page.'/index.php';
    else
        include $page.'.php';

    }
?>
<?php require_once('inc/footer.php') ?>

  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog   rounded-0 modal-md modal-dialog-centered" role="document">
      <div class="modal-content  rounded-0">
        <div class="modal-header  rounded-0">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body  rounded-0">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-flat btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog  rounded-0 modal-full-height  modal-md" role="document">
      <div class="modal-content rounded-0">
        <div class="modal-header rounded-0">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body rounded-0">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content rounded-0">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-flat btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-sm btn-flat btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>

</body>
</html>