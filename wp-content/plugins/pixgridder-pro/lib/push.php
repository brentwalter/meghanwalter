<?php
	$maxWidth = '100%';
	$minCols = stripslashes($_POST['pixgridder_hidden_min_cols']);
	$maxCols = stripslashes($_POST['pixgridder_hidden_max_cols']);
	$gutterW = stripslashes($_POST['pixgridder_css_gutter']).'%';
	$gutterH = stripslashes($_POST['pixgridder_css_gutter_h']).'%';
	$gridPadd = stripslashes($_POST['pixgridder_css_padding']).'%';
	$opacity_ms = stripslashes($_POST['pixgridder_opacity_ms']).'ms';
	$animation_ms = stripslashes($_POST['pixgridder_animation_ms']).'ms';
	$break = stripslashes(floatval($_POST['pixgridder_css_break'])).'px';
	$include = stripslashes($_POST['pixgridder_include_generated_css']);
  $selector = stripslashes($_POST['pixgridder_css_selector']);
  $selector = str_replace(", ", ",", $selector);
  $selector = explode(",", $selector);
  $unit = '%';

    $pixgridder_array_rules_ = unserialize($_POST['pixgridder_hidden_array_rules']); 
    $i = 0;

    if ( isset($pixgridder_array_rules_[$i]) && $pixgridder_array_rules_[$i]!='' ) {
        while($i<count($pixgridder_array_rules_)) {
            if ( $pixgridder_array_rules_[$i]['min'] < $minCols ) {
              $minCols = $pixgridder_array_rules_[$i]['min'];
            }
            if ( $pixgridder_array_rules_[$i]['max'] > $maxCols ) {
              $maxCols = $pixgridder_array_rules_[$i]['max'];
            }
            $i++;
        }
    }

  $css = stripslashes($_POST['pixgridder_css_code']);

  $css .= "\n/******************
  Zoom in
******************/
@-webkit-keyframes pixZoomIn {
  0% {
    -webkit-transform: scale(0, 0);
  }
  100% {
    -webkit-transform: scale(1, 1);
  }
}
@-moz-keyframes pixZoomIn {
  0% {
    -moz-transform: scale(0, 0);
  }
  100% {
    -moz-transform: scale(1, 1);
  }
}
@-o-keyframes pixZoomIn {
  0% {
    -o-transform: scale(0, 0);
  }
  100% {
    -o-transform: scale(1, 1);
  }
}
@-ms-keyframes pixZoomIn {
  0% {
    -ms-transform: scale(0, 0);
  }
  100% {
    -ms-transform: scale(1, 1);
  }
}
@keyframes pixZoomIn {
  0% {
    transform: scale(0, 0);
  }
  100% {
    transform: scale(1, 1);
  }
}

/******************
  Zoom out
******************/
@-webkit-keyframes pixZoomOut {
  0% {
    -webkit-transform: scale(1.5, 1.5);
  }
  100% {
    -webkit-transform: scale(1, 1);
  }
}
@-moz-keyframes pixZoomOut {
  0% {
    -moz-transform: scale(1.5, 1.5);
  }
  100% {
    -moz-transform: scale(1, 1);
  }
}
@-o-keyframes pixZoomOut {
  0% {
    -o-transform: scale(1.5, 1.5);
  }
  100% {
    -o-transform: scale(1, 1);
  }
}
@-ms-keyframes pixZoomOut {
  0% {
    -ms-transform: scale(1.5, 1.5);
  }
  100% {
    -ms-transform: scale(1, 1);
  }
}
@keyframes pixZoomOut {
  0% {
    transform: scale(1.5, 1.5);
  }
  100% {
    transform: scale(1, 1);
  }
}

/******************
  Fade down
******************/
@-webkit-keyframes pixFadeDown {
  0% {
    -webkit-transform: translate(0, -100px);
  }
  100% {
    -webkit-transform: translate(0, 0);
  }
}
@-moz-keyframes pixFadeDown {
  0% {
    -moz-transform: translate(0, -100px);
  }
  100% {
    -moz-transform: translate(0, 0);
  }
}
@-o-keyframes pixFadeDown {
  0% {
    -o-transform: translate(0, -100px);
  }
  100% {
    -o-transform: translate(0, 0);
  }
}
@-ms-keyframes pixFadeDown {
  0% {
    -ms-transform: translate(0, -100px);
  }
  100% {
    -ms-transform: translate(0, 0);
  }
}
@keyframes pixFadeDown {
  0% {
    transform: translate(0, -100px);
  }
  100% {
    transform: translate(0, 0);
  }
}

/******************
  Rotate out
******************/
@-webkit-keyframes pixRotateOut {
  0% {
    -webkit-transform: rotate(25deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
  }
}
@-moz-keyframes pixRotateOut {
  0% {
    -moz-transform: rotate(25deg);
  }
  100% {
    -moz-transform: rotate(0deg);
  }
}
@-o-keyframes pixRotateOut {
  0% {
    -o-transform: rotate(25deg);
  }
  100% {
    -o-transform: rotate(0deg);
  }
}
@-ms-keyframes pixRotateOut {
  0% {
    -ms-transform: rotate(25deg);
  }
  100% {
    -ms-transform: rotate(0deg);
  }
}
@keyframes pixRotateOut {
  0% {
    transform: rotate(25deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

/******************
  Rotate in
******************/
@-webkit-keyframes pixRotateIn {
  0% {
    -webkit-transform: rotate(-25deg);
  }
  100% {
    -webkit-transform: rotate(0deg);
  }
}
@-moz-keyframes pixRotateIn {
  0% {
    -moz-transform: rotate(-25deg);
  }
  100% {
    -moz-transform: rotate(0deg);
  }
}
@-o-keyframes pixRotateIn {
  0% {
    -o-transform: rotate(-25deg);
  }
  100% {
    -o-transform: rotate(0deg);
  }
}
@-ms-keyframes pixRotateIn {
  0% {
    -ms-transform: rotate(-25deg);
  }
  100% {
    -ms-transform: rotate(0deg);
  }
}
@keyframes pixRotateIn {
  0% {
    transform: rotate(-25deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

/******************
  Fade up
******************/
@-webkit-keyframes pixFadeUp {
  0% {
    -webkit-transform: translate(0, 100px);
  }
  100% {
    -webkit-transform: translate(0, 0);
  }
}
@-moz-keyframes pixFadeUp {
  0% {
    -moz-transform: translate(0, 100px);
  }
  100% {
    -moz-transform: translate(0, 0);
  }
}
@-o-keyframes pixFadeUp {
  0% {
    -o-transform: translate(0, 100px);
  }
  100% {
    -o-transform: translate(0, 0);
  }
}
@-ms-keyframes pixFadeUp {
  0% {
    -ms-transform: translate(0, 100px);
  }
  100% {
    -ms-transform: translate(0, 0);
  }
}
@keyframes pixFadeUp {
  0% {
    transform: translate(0, 100px);
  }
  100% {
    transform: translate(0, 0);
  }
}

/******************
  Fade left
******************/
@-webkit-keyframes pixFadeLeft {
  0% {
    -webkit-transform: translate(-100px, 0);
  }
  100% {
    -webkit-transform: translate(0, 0);
  }
}
@-moz-keyframes pixFadeLeft {
  0% {
    -moz-transform: translate(-100px, 0);
  }
  100% {
    -moz-transform: translate(0, 0);
  }
}
@-o-keyframes pixFadeLeft {
  0% {
    -o-transform: translate(-100px, 0);
  }
  100% {
    -o-transform: translate(0, 0);
  }
}
@-ms-keyframes pixFadeLeft {
  0% {
    -ms-transform: translate(-100px, 0);
  }
  100% {
    -ms-transform: translate(0, 0);
  }
}
@keyframes pixFadeLeft {
  0% {
    transform: translate(-100px, 0);
  }
  100% {
    transform: translate(0, 0);
  }
}

/******************
  Fade right
******************/
@-webkit-keyframes pixFadeRight {
  0% {
    -webkit-transform: translate(100px, 0);
  }
  100% {
    -webkit-transform: translate(0, 0);
  }
}
@-moz-keyframes pixFadeRight {
  0% {
    -moz-transform: translate(100px, 0);
  }
  100% {
    -moz-transform: translate(0, 0);
  }
}
@-o-keyframes pixFadeRight {
  0% {
    -o-transform: translate(100px, 0);
  }
  100% {
    -o-transform: translate(0, 0);
  }
}
@-ms-keyframes pixFadeRight {
  0% {
    -ms-transform: translate(100px, 0);
  }
  100% {
    -ms-transform: translate(0, 0);
  }
}
@keyframes pixFadeRight {
  0% {
    transform: translate(100px, 0);
  }
  100% {
    transform: translate(0, 0);
  }
}

/******************
  Flip clock effect
******************/
@-webkit-keyframes pixFlipClock {
  0% {
    -webkit-transform: perspective( 2000px ) rotateX( 90deg );
  }
  100% {
    -webkit-transform: perspective( 2000px ) rotateX( 0 );
  }
}
@-moz-keyframes pixFlipClock {
  0% {
    -moz-transform: perspective( 2000px ) rotateX( 90deg );
  }
  100% {
    -moz-transform: perspective( 2000px ) rotateX( 0 );
  }
}
@-o-keyframes pixFlipClock {
  0% {
    -o-transform: perspective( 2000px ) rotateX( 90deg );
  }
  100% {
    -o-transform: perspective( 2000px ) rotateX( 0 );
  }
}
@-ms-keyframes pixFlipClock {
  0% {
    -ms-transform: perspective( 2000px ) rotateX( 90deg );
  }
  100% {
    -ms-transform: perspective( 2000px ) rotateX( 0 );
  }
}
@keyframes pixFlipClock {
  0% {
    transform: perspective( 2000px ) rotateX( 90deg );
  }
  100% {
    transform: perspective( 2000px ) rotateX( 0 );
  }
}

/******************
  Swing effect
******************/
@-webkit-keyframes pixSwing {
  0% {
    -webkit-transform: perspective( 1000px ) rotateX( -180deg );
  }
  100% {
    -webkit-transform: perspective( 1000px ) rotateX( 0 );
  }
}
@-moz-keyframes pixSwing {
  0% {
    -moz-transform: perspective( 1000px ) rotateX( -180deg );
  }
  100% {
    -moz-transform: perspective( 1000px ) rotateX( 0 );
  }
}
@-o-keyframes pixSwing {
  0% {
    -o-transform: perspective( 1000px ) rotateX( -180deg );
  }
  100% {
    -o-transform: perspective( 1000px ) rotateX( 0 );
  }
}
@-ms-keyframes pixSwing {
  0% {
    -ms-transform: perspective( 1000px ) rotateX( -180deg );
  }
  100% {
    -ms-transform: perspective( 1000px ) rotateX( 0 );
  }
}
@keyframes pixSwing {
  0% {
    transform: perspective( 1000px ) rotateX( -180deg );
  }
  100% {
    transform: perspective( 1000px ) rotateX( 0 );
  }
}

/******************
  Turn forward
******************/
@-webkit-keyframes pixTurnForward {
  0% {
    -webkit-transform: perspective( 1000px ) rotateY( -90deg );
  }
  100% {
    -webkit-transform: perspective( 1000px ) rotateY( 0 );
  }
}
@-moz-keyframes pixTurnForward {
  0% {
    -moz-transform: perspective( 1000px ) rotateY( -90deg );
  }
  100% {
    -moz-transform: perspective( 1000px ) rotateY( 0 );
  }
}
@-o-keyframes pixTurnForward {
  0% {
    -o-transform: rotateY( -90deg );
  }
  100% {
    -o-transform: rotateY( 0 );
  }
}
@-ms-keyframes pixTurnForward {
  0% {
    -ms-transform: perspective( 1000px ) rotateY( -90deg );
  }
  100% {
    -ms-transform: perspective( 1000px ) rotateY( 0 );
  }
}
@keyframes pixTurnForward {
  0% {
    transform: rotateY( -90deg );
  }
  100% {
    transform: rotateY( 0 );
  }
}

/******************
  Turn backward
******************/
@-webkit-keyframes pixTurnBackward {
  0% {
    -webkit-transform: perspective( 1000px ) rotateY( 90deg );
  }
  100% {
    -webkit-transform: perspective( 1000px ) rotateY( 0 );
  }
}
@-moz-keyframes pixTurnBackward {
  0% {
    -moz-transform: perspective( 1000px ) rotateY( 90deg );
  }
  100% {
    -moz-transform: perspective( 1000px ) rotateY( 0 );
  }
}
@-o-keyframes pixTurnBackward {
  0% {
    -o-transform: rotateY( 90deg );
  }
  100% {
    -o-transform: rotateY( 0 );
  }
}
@-ms-keyframes pixTurnBackward {
  0% {
    -ms-transform: perspective( 1000px ) rotateY( 90deg );
  }
  100% {
    -ms-transform: perspective( 1000px ) rotateY( 0 );
  }
}
@keyframes pixTurnBackward {
  0% {
    transform: rotateY( 90deg );
  }
  100% {
    transform: rotateY( 0 );
  }
}";

foreach ($selector as &$sel) {
    $css .= "\nbody.pix-scroll-load $sel {
  opacity: 0;
}
body.pix-scroll-load.available $sel {
  opacity: 1;
}
body.pix-scroll-load.available $sel.pix-fadeIn, 
body.pix-scroll-load.available $sel.pix-fadeDown, 
body.pix-scroll-load.available $sel.pix-fadeUp, 
body.pix-scroll-load.available $sel.pix-fadeLeft, 
body.pix-scroll-load.available $sel.pix-fadeRight, 
body.pix-scroll-load.available $sel.pix-zoomIn, 
body.pix-scroll-load.available $sel.pix-zoomOut, 
body.pix-scroll-load.available $sel.pix-rotateIn, 
body.pix-scroll-load.available $sel.pix-rotateOut,
body.pix-scroll-load.available $sel.pix-flipClock,
body.pix-scroll-load.available $sel.pix-swing,
body.pix-scroll-load.available $sel.pix-turnBackward,
body.pix-scroll-load.available $sel.pix-turnForward,

body.pix-scroll-load.available .pix-fadeIn, 
body.pix-scroll-load.available .pix-fadeDown, 
body.pix-scroll-load.available .pix-fadeUp, 
body.pix-scroll-load.available .pix-fadeLeft, 
body.pix-scroll-load.available .pix-fadeRight, 
body.pix-scroll-load.available .pix-zoomIn, 
body.pix-scroll-load.available .pix-zoomOut, 
body.pix-scroll-load.available .pix-rotateIn, 
body.pix-scroll-load.available .pix-rotateOut,
body.pix-scroll-load.available .pix-flipClock,
body.pix-scroll-load.available .pix-swing,
body.pix-scroll-load.available .pix-turnBackward,
body.pix-scroll-load.available .pix-turnForward {
  opacity: 0;
}
body.pix-scroll-load .pix-loaded,
body.pix-scroll-load $sel.pix-loaded {
  opacity: 1!important;
  -webkit-transition: opacity $opacity_ms ease-in-out;
  -moz-transition: opacity $opacity_ms ease-in-out;
  -o-transition: opacity $opacity_ms ease-in-out;
  transition: opacity $opacity_ms ease-in-out;
  -webkit-backface-visibility: hidden;
  -webkit-perspective: 1000;
}
body.pix-scroll-load .pix-loaded.pix-zoomIn,
body.pix-scroll-load $sel.pix-loaded.pix-zoomIn {
  -webkit-animation: pixZoomIn $animation_ms ease-in-out;
  -moz-animation: pixZoomIn $animation_ms ease-in-out;
  -o-animation: pixZoomIn $animation_ms ease-in-out;
  -ms-animation: pixZoomIn $animation_ms ease-in-out;
  animation: pixZoomIn $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-zoomOut,
body.pix-scroll-load $sel.pix-loaded.pix-zoomOut {
  -webkit-animation: pixZoomOut $animation_ms ease-in-out;
  -moz-animation: pixZoomOut $animation_ms ease-in-out;
  -o-animation: pixZoomOut $animation_ms ease-in-out;
  -ms-animation: pixZoomOut $animation_ms ease-in-out;
  animation: pixZoomOut $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-fadeDown,
body.pix-scroll-load $sel.pix-loaded.pix-fadeDown {
  -webkit-animation: pixFadeDown $animation_ms ease-in-out;
  -moz-animation: pixFadeDown $animation_ms ease-in-out;
  -o-animation: pixFadeDown $animation_ms ease-in-out;
  -ms-animation: pixFadeDown $animation_ms ease-in-out;
  animation: pixFadeDown $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-fadeUp,
body.pix-scroll-load $sel.pix-loaded.pix-fadeUp {
  -webkit-animation: pixFadeUp $animation_ms ease-in-out;
  -moz-animation: pixFadeUp $animation_ms ease-in-out;
  -o-animation: pixFadeUp $animation_ms ease-in-out;
  -ms-animation: pixFadeUp $animation_ms ease-in-out;
  animation: pixFadeUp $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-fadeLeft,
body.pix-scroll-load $sel.pix-loaded.pix-fadeLeft {
  -webkit-animation: pixFadeLeft $animation_ms ease-in-out;
  -moz-animation: pixFadeLeft $animation_ms ease-in-out;
  -o-animation: pixFadeLeft $animation_ms ease-in-out;
  -ms-animation: pixFadeLeft $animation_ms ease-in-out;
  animation: pixFadeLeft $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-fadeRight,
body.pix-scroll-load $sel.pix-loaded.pix-fadeRight {
  -webkit-animation: pixFadeRight $animation_ms ease-in-out;
  -moz-animation: pixFadeRight $animation_ms ease-in-out;
  -o-animation: pixFadeRight $animation_ms ease-in-out;
  -ms-animation: pixFadeRight $animation_ms ease-in-out;
  animation: pixFadeRight $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-rotateOut,
body.pix-scroll-load $sel.pix-loaded.pix-rotateOut {
  -webkit-transform-origin: 100% 100%;
  -moz-transform-origin: 100% 100%;
  -o-transform-origin: 100% 100%;
  -ms-transform-origin: 100% 100%;
  transform-origin: 100% 100%;
  -webkit-animation: pixRotateOut $animation_ms ease-in-out;
  -moz-animation: pixRotateOut $animation_ms ease-in-out;
  -o-animation: pixRotateOut $animation_ms ease-in-out;
  -ms-animation: pixRotateOut $animation_ms ease-in-out;
  animation: pixRotateOut $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-rotateIn,
body.pix-scroll-load $sel.pix-loaded.pix-rotateIn {
  -webkit-transform-origin: 0% 100%;
  -moz-transform-origin: 0% 100%;
  -o-transform-origin: 0% 100%;
  -ms-transform-origin: 0% 100%;
  transform-origin: 0% 100%;
  -webkit-animation: pixRotateIn $animation_ms ease-in-out;
  -moz-animation: pixRotateIn $animation_ms ease-in-out;
  -o-animation: pixRotateIn $animation_ms ease-in-out;
  -ms-animation: pixRotateIn $animation_ms ease-in-out;
  animation: pixRotateIn $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-flipClock,
body.pix-scroll-load $sel.pix-loaded.pix-flipClock {
  -webkit-transform-origin: 50% 0%;
  -moz-transform-origin: 50% 0%;
  -ms-transform-origin: 50% 0%;
  -o-transform-origin: 50% 0%;
  transform-origin: 50% 0%;
  -webkit-animation: pixFlipClock $animation_ms ease-in-out;
  -moz-animation: pixFlipClock $animation_ms ease-in-out;
  -o-animation: pixFlipClock $animation_ms ease-in-out;
  -ms-animation: pixFlipClock $animation_ms ease-in-out;
  animation: pixFlipClock $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-swing,
body.pix-scroll-load $sel.pix-loaded.pix-swing {
  -webkit-transform-origin: 50% 0%;
  -moz-transform-origin: 50% 0%;
  -ms-transform-origin: 50% 0%;
  -o-transform-origin: 50% 0%;
  transform-origin: 50% 0%;
  -webkit-animation: pixSwing $animation_ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -moz-animation: pixSwing $animation_ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -o-animation: pixSwing $animation_ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -ms-animation: pixSwing $animation_ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  animation: pixSwing $animation_ms cubic-bezier(0.175, 0.885, 0.32, 1.275);
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-turnBackward,
body.pix-scroll-load $sel.pix-loaded.pix-turnBackward {
  -webkit-transform-origin: 100% 0%;
  -moz-transform-origin: 100% 0%;
  -ms-transform-origin: 100% 0%;
  -o-transform-origin: 100% 0%;
  transform-origin: 100% 0%;
  -webkit-animation: pixTurnBackward $animation_ms ease-in-out;
  -moz-animation: pixTurnBackward $animation_ms ease-in-out;
  -o-animation: pixTurnBackward $animation_ms ease-in-out;
  -ms-animation: pixTurnBackward $animation_ms ease-in-out;
  animation: pixTurnBackward $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
body.pix-scroll-load .pix-loaded.pix-turnForward,
body.pix-scroll-load $sel.pix-loaded.pix-turnForward {
  -webkit-transform-origin: 0% 0%;
  -moz-transform-origin: 0% 0%;
  -ms-transform-origin: 0% 0%;
  -o-transform-origin: 0% 0%;
  transform-origin: 0% 0%;
  -webkit-animation: pixTurnForward $animation_ms ease-in-out;
  -moz-animation: pixTurnForward $animation_ms ease-in-out;
  -o-animation: pixTurnForward $animation_ms ease-in-out;
  -ms-animation: pixTurnForward $animation_ms ease-in-out;
  animation: pixTurnForward $animation_ms ease-in-out;
  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  -o-animation-fill-mode: forwards;
  -ms-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}

body.pix-scroll-load .pix-loaded-inanim,
body.pix-scroll-load $sel.pix-loaded-inanim {
  opacity: 1;
}";
}

  if ( isset($include) && $include == 'true' ) {
    $css .= "\n.pixgridder .row {
  clear: both;
  display: block;
  position: relative;
  z-index: 0;
}
.pixgridder .row:after, .pixgridder .row:before {
  content: '';
  display: table;
}
.pixgridder .row:after {
  clear: both;
}
.pixgridder .column:first-child {
  margin-left: 0;
}
.pixgridder .column {
  background: transparent;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  float: left;
  margin-left: $gutterW;
  margin-bottom: $gutterH;
  padding: $gridPadd;
}
.pixgridder .column img {
  height: auto;
  max-width: $maxWidth;
}";



    for ($i = $minCols; $i <= $maxCols; $i++) {
      for ($ii = 1; $ii <= $i; $ii++) {
        $css .= "\n.pixgridder [data-cols=\"$i\"] [data-col=\"$ii\"] {";
        if ($ii == $i) {
          $css .= "\n\twidth: ";
          $css .= ( ( ( $maxWidth - 0 ) / $i ) * $ii );
          $css .= "$unit;\n}";
        } else {
          $css .= "\n\twidth: ";
          $css .= ( ( ( $maxWidth - ( $gutterW * ( ($i/$ii) - 1 ) ) ) / $i ) * $ii );
          $css .= "$unit;\n}";
        }
      }

    }


    if ( isset($break) && $break != '' ) {
      $css .= "\n@media only screen and (max-width: $break) {";
      for ($i = $minCols; $i <= $maxCols; $i++) {
        for ($ii = 1; $ii <= $i; $ii++) {
              if ( $i < $maxCols || $ii < $i ) {
            $css .= "\n\t.pixgridder [data-cols=\"$i\"] [data-col=\"$ii\"] ,";
          } else {
            $css .= "\n\t.pixgridder [data-cols=\"$i\"] [data-col=\"$ii\"] {";
          } 
        }
      }
      $css .= "\n\t\tmargin-left: 0;";
      $css .= "\n\t\twidth: $maxWidth;";
      $css .= "\n\t}";
      $css .= "\n}";
    }
  }

  echo $css; 
  exit;
?>