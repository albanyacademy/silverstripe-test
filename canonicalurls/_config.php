<?php

Object::add_extension("RequestHandler", "CanonicalURLHandler");
Object::add_extension("ContentController", "CanonicalURLHandler");
Object::add_extension("ModelAsController", "CanonicalURLHandler");