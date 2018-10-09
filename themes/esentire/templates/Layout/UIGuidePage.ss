<h2>Code Block - gulp.js</h2>
<div class="whatisgulp">
    <div class="container-lrg">
        <div class="col-12">
            <div class="editor-window">
                <div class="editor-menubar">
                    <span class="editor-button close"></span>
                    <span class="editor-button minimize"></span>
                    <span class="editor-button maximize"></span>
                    <span class="editor-filename">gulpfile.js</span>
                </div>
                <pre><code class="javascript hljs">
<span class="hljs-keyword">var</span> gulp = <span class="hljs-built_in">require</span>(<span class="hljs-string">'gulp'</span>);
<span class="hljs-keyword">var</span> pug = <span class="mobile-show"><br>  </span><span class="hljs-built_in">require</span>(<span class="hljs-string">'gulp-pug'</span>);
<span class="hljs-keyword">var</span> less = <span class="mobile-show"><br>  </span><span class="hljs-built_in">require</span>(<span class="hljs-string">'gulp-less'</span>);
<span class="hljs-keyword">var</span> minifyCSS = <span class="mobile-show"><br>  </span><span class="hljs-built_in">require</span>(<span class="hljs-string">'gulp-csso'</span>);
<span class="hljs-keyword">var</span> concat = <span class="mobile-show"><br>  </span><span class="hljs-built_in">require</span>(<span class="hljs-string">'gulp-concat'</span>);
<span class="hljs-keyword">var</span> sourcemaps = <span class="mobile-show"><br>  </span><span class="hljs-built_in">require</span>(<span class="hljs-string">'gulp-sourcemaps'</span>);

gulp.task(<span class="hljs-string">'html'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
  <span class="hljs-keyword">return</span> gulp.src(<span class="mobile-show"><br>      </span><span class="hljs-string">'client/templates/*.pug'</span><span class="mobile-show"><br>    </span>)
    .pipe(pug())
    .pipe(gulp.dest(<span class="mobile-show"><br>      </span><span class="hljs-string">'build/html'</span><span class="mobile-show"><br>    </span>))
});

gulp.task(<span class="hljs-string">'css'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
  <span class="hljs-keyword">return</span> gulp.src(<span class="mobile-show"><br>      </span><span class="hljs-string">'client/templates/*.less'</span><span class="mobile-show"><br>    </span>)
    .pipe(less())
    .pipe(minifyCSS())
    .pipe(gulp.dest(<span class="mobile-show"><br>      </span><span class="hljs-string">'build/css'</span><span class="mobile-show"><br>    </span>))
});

gulp.task(<span class="hljs-string">'js'</span>, <span class="hljs-function"><span class="hljs-keyword">function</span>(<span class="hljs-params"></span>)</span>{
  <span class="hljs-keyword">return</span> gulp.src(<span class="mobile-show"><br>      </span><span class="hljs-string">'client/javascript/*.js'</span><span class="mobile-show"><br>    </span>)
    .pipe(sourcemaps.init())
    .pipe(concat(<span class="mobile-show"><br>      </span><span class="hljs-string">'app.min.js'</span><span class="mobile-show"><br>    </span>))
    .pipe(sourcemaps.write())
    .pipe(gulp.dest(<span class="mobile-show"><br>      </span><span class="hljs-string">'build/js'</span><span class="mobile-show"><br>    </span>))
});

gulp.task(<span class="hljs-string">'default'</span>, <span class="mobile-show"><br>  </span>[ <span class="hljs-string">'html'</span>, <span class="hljs-string">'css'</span>, <span class="hljs-string">'js'</span> ]<span class="mobile-show"><br></span>);
          </code></pre>
            </div>
        </div>
    </div>
</div>

