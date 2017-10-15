<?php

/**
 * Created by FsFlex.
 * User: VH
 * Date: 9/29/2017
 * Time: 11:14 AM
 */
class RevSliderSlideEditor
{
    public function getTemplate()
    {
        $editor_helper = new RevSliderSlideEditorHelper();
        $data = $editor_helper->getArrInitData();
        extract($data['global']);
        $sgfamilies = (!empty($slide_editor_scripts_library['sgfamilies'])) ? $slide_editor_scripts_library['sgfamilies'] : array();
        ob_start();
        ?>
        <?php
        echo $this->script_library_html($sgfamilies);
        ?>
        <?php if ($slide['isStaticSlide']) : ?>
        <input type="hidden" id="sliderid" value="<?php echo $slider['id'] ?>"/>
    <?php endif; ?>
        <div class="wrap settings_wrap">
            <div class="clear_both"></div>
            <?php echo $this->breadcrumbs_html($data) ?>
            <?php echo $this->slide_selector_html($data) ?>
            <?php echo $this->slide_general_settings_html($data); ?>
            <?php echo $html_idesw ?>
        </div>
        <div class="vert_sap"></div>


        <div id="dialog_rename_animation" class="dialog_rename_animation" title="<?php echo t("Rename Animation") ?>"
             style="display:none;">
            <div style="margin-top:14px">
                <span style="margin-right:15px"><?php echo t("Rename to:") ?></span><input id="rs-rename-animation"
                                                                                           type="text"
                                                                                           name="rs-rename-animation"
                                                                                           value=""/>
            </div>
        </div>
        <?php
            if($slide['isStaticSlide'])
                $slideID = $slide['id'];
        ?>
        <script type="text/javascript">
            var g_patternViewSlide = '<?php echo $patternViewSlide ?>';

            var g_messageDeleteSlide = "<?php echo t("Delete this slide?") ?>";
            document.addEventListener("DOMContentLoaded", function () {
                RevSliderAdmin.initEditSlideView(<?php echo $slideID ?>,<?php echo $sliderID ?>,<?php echo ($slide['isStaticSlide']) ? 'true' : 'false' ?>);

                UniteLayersRev.setInitSlideIds(<?php echo $mslide_list ?>)
                ;
            });
            var curSlideID = <?php echo $slideID ?>;
            var curSliderID = <?php echo $sliderID ?>;
        </script>
        <?php
            $system_dialog_template = new RevSliderSystemDialog();
            echo $system_dialog_template->copy_move_dialog_html($data);
        ?>

        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                jQuery('#rs-do-set-style-on-devices').click(function () {
                    var layer = UniteLayersRev.getCurrentLayer();

                    if (layer !== false) {
                        if (layer['static_styles'] == undefined) layer['static_styles'] = {};

                        var mcolor = jQuery('input[name="color_static"]').val();
                        var mfontsize = jQuery('input[name="font_size_static"]').val();
                        var mlineheight = jQuery('input[name="line_height_static"]').val();
                        var mfontweight = jQuery('select[name="font_weight_static"] option:selected').val();

                        jQuery('.rs-set-device-chk').each(function () {
                            if (jQuery(this).is(':checked')) {
                                var dt = jQuery(this).data('device'); //which device to set on
                                var so = jQuery(this).data('seton'); //set on color/font-size and so on
                                var mval;
                                switch (so) {
                                    case 'color':
                                        mval = mcolor;
                                        break;
                                    case 'font-size':
                                        mval = mfontsize;
                                        break;
                                    case 'line-height':
                                        mval = mlineheight;
                                        break;
                                    case 'font-weight':
                                        mval = mfontweight;
                                        break;
                                }

                                layer['static_styles'] = UniteLayersRev.setVal(layer['static_styles'], so, mval, false, [dt]);
                            }
                        });

                        //give status that it has been done

                        jQuery('#rs-set-style-on-devices-dialog').toggle();
                    }
                });
            });
        </script>

        <?php
        return ob_get_clean();
    }

    public function script_library_html($sgfamilies)
    {
        ob_start();
        ?>
        <script type="text/javascript">

            /*
             * Copyright 2015 Small Batch, Inc.
             *
             * Licensed under the Apache License, Version 2.0 (the "License"); you may not
             * use this file except in compliance with the License. You may obtain a copy of
             * the License at
             *
             * http://www.apache.org/licenses/LICENSE-2.0
             *
             * Unless required by applicable law or agreed to in writing, software
             * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
             * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
             * License for the specific language governing permissions and limitations under
             * the License.
             */
            /* Web Font Loader v1.5.18 - (c) Adobe Systems, Google. License: Apache 2.0 */
            ;
            (function (window, document, undefined) {
                function aa(a, b, c) {
                    return a.call.apply(a.bind, arguments)
                }

                function ba(a, b, c) {
                    if (!a)throw Error();
                    if (2 < arguments.length) {
                        var d = Array.prototype.slice.call(arguments, 2);
                        return function () {
                            var c = Array.prototype.slice.call(arguments);
                            Array.prototype.unshift.apply(c, d);
                            return a.apply(b, c)
                        }
                    }
                    return function () {
                        return a.apply(b, arguments)
                    }
                }

                function k(a, b, c) {
                    k = Function.prototype.bind && -1 != Function.prototype.bind.toString().indexOf("native code") ? aa : ba;
                    return k.apply(null, arguments)
                }

                var n = Date.now || function () {
                        return +new Date
                    };

                function q(a, b) {
                    this.K = a;
                    this.w = b || a;
                    this.G = this.w.document
                }

                q.prototype.createElement = function (a, b, c) {
                    a = this.G.createElement(a);
                    if (b)for (var d in b)b.hasOwnProperty(d) && ("style" == d ? a.style.cssText = b[d] : a.setAttribute(d, b[d]));
                    c && a.appendChild(this.G.createTextNode(c));
                    return a
                };
                function r(a, b, c) {
                    a = a.G.getElementsByTagName(b)[0];
                    a || (a = document.documentElement);
                    a && a.lastChild && a.insertBefore(c, a.lastChild)
                }

                function ca(a, b) {
                    function c() {
                        a.G.body ? b() : setTimeout(c, 0)
                    }

                    c()
                }

                function s(a, b, c) {
                    b = b || [];
                    c = c || [];
                    for (var d = a.className.split(/\s+/), e = 0; e < b.length; e += 1) {
                        for (var f = !1, g = 0; g < d.length; g += 1)if (b[e] === d[g]) {
                            f = !0;
                            break
                        }
                        f || d.push(b[e])
                    }
                    b = [];
                    for (e = 0; e < d.length; e += 1) {
                        f = !1;
                        for (g = 0; g < c.length; g += 1)if (d[e] === c[g]) {
                            f = !0;
                            break
                        }
                        f || b.push(d[e])
                    }
                    a.className = b.join(" ").replace(/\s+/g, " ").replace(/^\s+|\s+$/, "")
                }

                function t(a, b) {
                    for (var c = a.className.split(/\s+/), d = 0, e = c.length; d < e; d++)if (c[d] == b)return !0;
                    return !1
                }

                function u(a) {
                    if ("string" === typeof a.na)return a.na;
                    var b = a.w.location.protocol;
                    "about:" == b && (b = a.K.location.protocol);
                    return "https:" == b ? "https:" : "http:"
                }

                function v(a, b) {
                    var c = a.createElement("link", {rel: "stylesheet", href: b, media: "all"}), d = !1;
                    c.onload = function () {
                        d || (d = !0)
                    };
                    c.onerror = function () {
                        d || (d = !0)
                    };
                    r(a, "head", c)
                }

                function w(a, b, c, d) {
                    var e = a.G.getElementsByTagName("head")[0];
                    if (e) {
                        var f = a.createElement("script", {src: b}), g = !1;
                        f.onload = f.onreadystatechange = function () {
                            g || this.readyState && "loaded" != this.readyState && "complete" != this.readyState || (g = !0, c && c(null), f.onload = f.onreadystatechange = null, "HEAD" == f.parentNode.tagName && e.removeChild(f))
                        };
                        e.appendChild(f);
                        window.setTimeout(function () {
                            g || (g = !0, c && c(Error("Script load timeout")))
                        }, d || 5E3);
                        return f
                    }
                    return null
                };
                function x(a, b) {
                    this.Y = a;
                    this.ga = b
                };
                function y(a, b, c, d) {
                    this.c = null != a ? a : null;
                    this.g = null != b ? b : null;
                    this.D = null != c ? c : null;
                    this.e = null != d ? d : null
                }

                var da = /^([0-9]+)(?:[\._-]([0-9]+))?(?:[\._-]([0-9]+))?(?:[\._+-]?(.*))?$/;
                y.prototype.compare = function (a) {
                    return this.c > a.c || this.c === a.c && this.g > a.g || this.c === a.c && this.g === a.g && this.D > a.D ? 1 : this.c < a.c || this.c === a.c && this.g < a.g || this.c === a.c && this.g === a.g && this.D < a.D ? -1 : 0
                };
                y.prototype.toString = function () {
                    return [this.c, this.g || "", this.D || "", this.e || ""].join("")
                };
                function z(a) {
                    a = da.exec(a);
                    var b = null, c = null, d = null, e = null;
                    a && (null !== a[1] && a[1] && (b = parseInt(a[1], 10)), null !== a[2] && a[2] && (c = parseInt(a[2], 10)), null !== a[3] && a[3] && (d = parseInt(a[3], 10)), null !== a[4] && a[4] && (e = /^[0-9]+$/.test(a[4]) ? parseInt(a[4], 10) : a[4]));
                    return new y(b, c, d, e)
                };
                function A(a, b, c, d, e, f, g, h) {
                    this.N = a;
                    this.k = h
                }

                A.prototype.getName = function () {
                    return this.N
                };
                function B(a) {
                    this.a = a
                }

                var ea = new A("Unknown", 0, 0, 0, 0, 0, 0, new x(!1, !1));
                B.prototype.parse = function () {
                    var a;
                    if (-1 != this.a.indexOf("MSIE") || -1 != this.a.indexOf("Trident/")) {
                        a = C(this);
                        var b = z(D(this)), c = null, d = E(this.a, /Trident\/([\d\w\.]+)/, 1), c = -1 != this.a.indexOf("MSIE") ? z(E(this.a, /MSIE ([\d\w\.]+)/, 1)) : z(E(this.a, /rv:([\d\w\.]+)/, 1));
                        "" != d && z(d);
                        a = new A("MSIE", 0, 0, 0, 0, 0, 0, new x("Windows" == a && 6 <= c.c || "Windows Phone" == a && 8 <= b.c, !1))
                    } else if (-1 != this.a.indexOf("Opera"))a:if (a = z(E(this.a, /Presto\/([\d\w\.]+)/, 1)), z(D(this)), null !== a.c || z(E(this.a, /rv:([^\)]+)/, 1)), -1 != this.a.indexOf("Opera Mini/")) a =
                        z(E(this.a, /Opera Mini\/([\d\.]+)/, 1)), a = new A("OperaMini", 0, 0, 0, C(this), 0, 0, new x(!1, !1)); else {
                        if (-1 != this.a.indexOf("Version/") && (a = z(E(this.a, /Version\/([\d\.]+)/, 1)), null !== a.c)) {
                            a = new A("Opera", 0, 0, 0, C(this), 0, 0, new x(10 <= a.c, !1));
                            break a
                        }
                        a = z(E(this.a, /Opera[\/ ]([\d\.]+)/, 1));
                        a = null !== a.c ? new A("Opera", 0, 0, 0, C(this), 0, 0, new x(10 <= a.c, !1)) : new A("Opera", 0, 0, 0, C(this), 0, 0, new x(!1, !1))
                    } else/OPR\/[\d.]+/.test(this.a) ? a = F(this) : /AppleWeb(K|k)it/.test(this.a) ? a = F(this) : -1 != this.a.indexOf("Gecko") ?
                        (a = "Unknown", b = new y, z(D(this)), b = !1, -1 != this.a.indexOf("Firefox") ? (a = "Firefox", b = z(E(this.a, /Firefox\/([\d\w\.]+)/, 1)), b = 3 <= b.c && 5 <= b.g) : -1 != this.a.indexOf("Mozilla") && (a = "Mozilla"), c = z(E(this.a, /rv:([^\)]+)/, 1)), b || (b = 1 < c.c || 1 == c.c && 9 < c.g || 1 == c.c && 9 == c.g && 2 <= c.D), a = new A(a, 0, 0, 0, C(this), 0, 0, new x(b, !1))) : a = ea;
                    return a
                };
                function C(a) {
                    var b = E(a.a, /(iPod|iPad|iPhone|Android|Windows Phone|BB\d{2}|BlackBerry)/, 1);
                    if ("" != b)return /BB\d{2}/.test(b) && (b = "BlackBerry"), b;
                    a = E(a.a, /(Linux|Mac_PowerPC|Macintosh|Windows|CrOS|PlayStation|CrKey)/, 1);
                    return "" != a ? ("Mac_PowerPC" == a ? a = "Macintosh" : "PlayStation" == a && (a = "Linux"), a) : "Unknown"
                }

                function D(a) {
                    var b = E(a.a, /(OS X|Windows NT|Android) ([^;)]+)/, 2);
                    if (b || (b = E(a.a, /Windows Phone( OS)? ([^;)]+)/, 2)) || (b = E(a.a, /(iPhone )?OS ([\d_]+)/, 2)))return b;
                    if (b = E(a.a, /(?:Linux|CrOS|CrKey) ([^;)]+)/, 1))for (var b = b.split(/\s/), c = 0; c < b.length; c += 1)if (/^[\d\._]+$/.test(b[c]))return b[c];
                    return (a = E(a.a, /(BB\d{2}|BlackBerry).*?Version\/([^\s]*)/, 2)) ? a : "Unknown"
                }

                function F(a) {
                    var b = C(a), c = z(D(a)), d = z(E(a.a, /AppleWeb(?:K|k)it\/([\d\.\+]+)/, 1)), e = "Unknown", f = new y, f = "Unknown", g = !1;
                    /OPR\/[\d.]+/.test(a.a) ? e = "Opera" : -1 != a.a.indexOf("Chrome") || -1 != a.a.indexOf("CrMo") || -1 != a.a.indexOf("CriOS") ? e = "Chrome" : /Silk\/\d/.test(a.a) ? e = "Silk" : "BlackBerry" == b || "Android" == b ? e = "BuiltinBrowser" : -1 != a.a.indexOf("PhantomJS") ? e = "PhantomJS" : -1 != a.a.indexOf("Safari") ? e = "Safari" : -1 != a.a.indexOf("AdobeAIR") ? e = "AdobeAIR" : -1 != a.a.indexOf("PlayStation") && (e = "BuiltinBrowser");
                    "BuiltinBrowser" ==
                    e ? f = "Unknown" : "Silk" == e ? f = E(a.a, /Silk\/([\d\._]+)/, 1) : "Chrome" == e ? f = E(a.a, /(Chrome|CrMo|CriOS)\/([\d\.]+)/, 2) : -1 != a.a.indexOf("Version/") ? f = E(a.a, /Version\/([\d\.\w]+)/, 1) : "AdobeAIR" == e ? f = E(a.a, /AdobeAIR\/([\d\.]+)/, 1) : "Opera" == e ? f = E(a.a, /OPR\/([\d.]+)/, 1) : "PhantomJS" == e && (f = E(a.a, /PhantomJS\/([\d.]+)/, 1));
                    f = z(f);
                    g = "AdobeAIR" == e ? 2 < f.c || 2 == f.c && 5 <= f.g : "BlackBerry" == b ? 10 <= c.c : "Android" == b ? 2 < c.c || 2 == c.c && 1 < c.g : 526 <= d.c || 525 <= d.c && 13 <= d.g;
                    return new A(e, 0, 0, 0, 0, 0, 0, new x(g, 536 > d.c || 536 == d.c && 11 > d.g))
                }

                function E(a, b, c) {
                    return (a = a.match(b)) && a[c] ? a[c] : ""
                };
                function G(a) {
                    this.ma = a || "-"
                }

                G.prototype.e = function (a) {
                    for (var b = [], c = 0; c < arguments.length; c++)b.push(arguments[c].replace(/[\W_]+/g, "").toLowerCase());
                    return b.join(this.ma)
                };
                function H(a, b) {
                    this.N = a;
                    this.Z = 4;
                    this.O = "n";
                    var c = (b || "n4").match(/^([nio])([1-9])$/i);
                    c && (this.O = c[1], this.Z = parseInt(c[2], 10))
                }

                H.prototype.getName = function () {
                    return this.N
                };
                function I(a) {
                    return a.O + a.Z
                }

                function ga(a) {
                    var b = 4, c = "n", d = null;
                    a && ((d = a.match(/(normal|oblique|italic)/i)) && d[1] && (c = d[1].substr(0, 1).toLowerCase()), (d = a.match(/([1-9]00|normal|bold)/i)) && d[1] && (/bold/i.test(d[1]) ? b = 7 : /[1-9]00/.test(d[1]) && (b = parseInt(d[1].substr(0, 1), 10))));
                    return c + b
                };
                function ha(a, b) {
                    this.d = a;
                    this.q = a.w.document.documentElement;
                    this.Q = b;
                    this.j = "wf";
                    this.h = new G("-");
                    this.ha = !1 !== b.events;
                    this.F = !1 !== b.classes
                }

                function J(a) {
                    if (a.F) {
                        var b = t(a.q, a.h.e(a.j, "active")), c = [], d = [a.h.e(a.j, "loading")];
                        b || c.push(a.h.e(a.j, "inactive"));
                        s(a.q, c, d)
                    }
                    K(a, "inactive")
                }

                function K(a, b, c) {
                    if (a.ha && a.Q[b])if (c) a.Q[b](c.getName(), I(c)); else a.Q[b]()
                };
                function ia() {
                    this.C = {}
                };
                function L(a, b) {
                    this.d = a;
                    this.I = b;
                    this.o = this.d.createElement("span", {"aria-hidden": "true"}, this.I)
                }

                function M(a, b) {
                    var c = a.o, d;
                    d = [];
                    for (var e = b.N.split(/,\s*/), f = 0; f < e.length; f++) {
                        var g = e[f].replace(/['"]/g, "");
                        -1 == g.indexOf(" ") ? d.push(g) : d.push("'" + g + "'")
                    }
                    d = d.join(",");
                    e = "normal";
                    "o" === b.O ? e = "oblique" : "i" === b.O && (e = "italic");
                    c.style.cssText = "display:block;position:absolute;top:-9999px;left:-9999px;font-size:300px;width:auto;height:auto;line-height:normal;margin:0;padding:0;font-variant:normal;white-space:nowrap;font-family:" + d + ";" + ("font-style:" + e + ";font-weight:" + (b.Z + "00") + ";")
                }

                function N(a) {
                    r(a.d, "body", a.o)
                }

                L.prototype.remove = function () {
                    var a = this.o;
                    a.parentNode && a.parentNode.removeChild(a)
                };
                function O(a, b, c, d, e, f, g, h) {
                    this.$ = a;
                    this.ka = b;
                    this.d = c;
                    this.m = d;
                    this.k = e;
                    this.I = h || "BESbswy";
                    this.v = {};
                    this.X = f || 3E3;
                    this.ca = g || null;
                    this.H = this.u = this.t = null;
                    this.t = new L(this.d, this.I);
                    this.u = new L(this.d, this.I);
                    this.H = new L(this.d, this.I);
                    M(this.t, new H("serif", I(this.m)));
                    M(this.u, new H("sans-serif", I(this.m)));
                    M(this.H, new H("monospace", I(this.m)));
                    N(this.t);
                    N(this.u);
                    N(this.H);
                    this.v.serif = this.t.o.offsetWidth;
                    this.v["sans-serif"] = this.u.o.offsetWidth;
                    this.v.monospace = this.H.o.offsetWidth
                }

                var P = {sa: "serif", ra: "sans-serif", qa: "monospace"};
                O.prototype.start = function () {
                    this.oa = n();
                    M(this.t, new H(this.m.getName() + ",serif", I(this.m)));
                    M(this.u, new H(this.m.getName() + ",sans-serif", I(this.m)));
                    Q(this)
                };
                function R(a, b, c) {
                    for (var d in P)if (P.hasOwnProperty(d) && b === a.v[P[d]] && c === a.v[P[d]])return !0;
                    return !1
                }

                function Q(a) {
                    var b = a.t.o.offsetWidth, c = a.u.o.offsetWidth;
                    b === a.v.serif && c === a.v["sans-serif"] || a.k.ga && R(a, b, c) ? n() - a.oa >= a.X ? a.k.ga && R(a, b, c) && (null === a.ca || a.ca.hasOwnProperty(a.m.getName())) ? S(a, a.$) : S(a, a.ka) : ja(a) : S(a, a.$)
                }

                function ja(a) {
                    setTimeout(k(function () {
                        Q(this)
                    }, a), 50)
                }

                function S(a, b) {
                    a.t.remove();
                    a.u.remove();
                    a.H.remove();
                    b(a.m)
                };
                function T(a, b, c, d) {
                    this.d = b;
                    this.A = c;
                    this.S = 0;
                    this.ea = this.ba = !1;
                    this.X = d;
                    this.k = a.k
                }

                function ka(a, b, c, d, e) {
                    c = c || {};
                    if (0 === b.length && e) J(a.A); else for (a.S += b.length, e && (a.ba = e), e = 0; e < b.length; e++) {
                        var f = b[e], g = c[f.getName()], h = a.A, m = f;
                        h.F && s(h.q, [h.h.e(h.j, m.getName(), I(m).toString(), "loading")]);
                        K(h, "fontloading", m);
                        h = null;
                        h = new O(k(a.ia, a), k(a.ja, a), a.d, f, a.k, a.X, d, g);
                        h.start()
                    }
                }

                T.prototype.ia = function (a) {
                    var b = this.A;
                    b.F && s(b.q, [b.h.e(b.j, a.getName(), I(a).toString(), "active")], [b.h.e(b.j, a.getName(), I(a).toString(), "loading"), b.h.e(b.j, a.getName(), I(a).toString(), "inactive")]);
                    K(b, "fontactive", a);
                    this.ea = !0;
                    la(this)
                };
                T.prototype.ja = function (a) {
                    var b = this.A;
                    if (b.F) {
                        var c = t(b.q, b.h.e(b.j, a.getName(), I(a).toString(), "active")), d = [], e = [b.h.e(b.j, a.getName(), I(a).toString(), "loading")];
                        c || d.push(b.h.e(b.j, a.getName(), I(a).toString(), "inactive"));
                        s(b.q, d, e)
                    }
                    K(b, "fontinactive", a);
                    la(this)
                };
                function la(a) {
                    0 == --a.S && a.ba && (a.ea ? (a = a.A, a.F && s(a.q, [a.h.e(a.j, "active")], [a.h.e(a.j, "loading"), a.h.e(a.j, "inactive")]), K(a, "active")) : J(a.A))
                };
                function U(a) {
                    this.K = a;
                    this.B = new ia;
                    this.pa = new B(a.navigator.userAgent);
                    this.a = this.pa.parse();
                    this.U = this.V = 0;
                    this.R = this.T = !0
                }

                U.prototype.load = function (a) {
                    this.d = new q(this.K, a.context || this.K);
                    this.T = !1 !== a.events;
                    this.R = !1 !== a.classes;
                    var b = new ha(this.d, a), c = [], d = a.timeout;
                    b.F && s(b.q, [b.h.e(b.j, "loading")]);
                    K(b, "loading");
                    var c = this.B, e = this.d, f = [], g;
                    for (g in a)if (a.hasOwnProperty(g)) {
                        var h = c.C[g];
                        h && f.push(h(a[g], e))
                    }
                    c = f;
                    this.U = this.V = c.length;
                    a = new T(this.a, this.d, b, d);
                    d = 0;
                    for (g = c.length; d < g; d++)e = c[d], e.L(this.a, k(this.la, this, e, b, a))
                };
                U.prototype.la = function (a, b, c, d) {
                    var e = this;
                    d ? a.load(function (a, b, d) {
                        ma(e, c, a, b, d)
                    }) : (a = 0 == --this.V, this.U--, a && 0 == this.U ? J(b) : (this.R || this.T) && ka(c, [], {}, null, a))
                };
                function ma(a, b, c, d, e) {
                    var f = 0 == --a.V;
                    (a.R || a.T) && setTimeout(function () {
                        ka(b, c, d || null, e || null, f)
                    }, 0)
                };
                function na(a, b, c) {
                    this.P = a ? a : b + oa;
                    this.s = [];
                    this.W = [];
                    this.fa = c || ""
                }

                var oa = "//fonts.googleapis.com/css";
                na.prototype.e = function () {
                    if (0 == this.s.length)throw Error("No fonts to load!");
                    if (-1 != this.P.indexOf("kit="))return this.P;
                    for (var a = this.s.length, b = [], c = 0; c < a; c++)b.push(this.s[c].replace(/ /g, "+"));
                    a = this.P + "?family=" + b.join("%7C");
                    0 < this.W.length && (a += "&subset=" + this.W.join(","));
                    0 < this.fa.length && (a += "&text=" + encodeURIComponent(this.fa));
                    return a
                };
                function pa(a) {
                    this.s = a;
                    this.da = [];
                    this.M = {}
                }

                var qa = {
                    latin: "BESbswy",
                    cyrillic: "&#1081;&#1103;&#1046;",
                    greek: "&#945;&#946;&#931;",
                    khmer: "&#x1780;&#x1781;&#x1782;",
                    Hanuman: "&#x1780;&#x1781;&#x1782;"
                }, ra = {
                    thin: "1",
                    extralight: "2",
                    "extra-light": "2",
                    ultralight: "2",
                    "ultra-light": "2",
                    light: "3",
                    regular: "4",
                    book: "4",
                    medium: "5",
                    "semi-bold": "6",
                    semibold: "6",
                    "demi-bold": "6",
                    demibold: "6",
                    bold: "7",
                    "extra-bold": "8",
                    extrabold: "8",
                    "ultra-bold": "8",
                    ultrabold: "8",
                    black: "9",
                    heavy: "9",
                    l: "3",
                    r: "4",
                    b: "7"
                }, sa = {
                    i: "i",
                    italic: "i",
                    n: "n",
                    normal: "n"
                }, ta = /^(thin|(?:(?:extra|ultra)-?)?light|regular|book|medium|(?:(?:semi|demi|extra|ultra)-?)?bold|black|heavy|l|r|b|[1-9]00)?(n|i|normal|italic)?$/;
                pa.prototype.parse = function () {
                    for (var a = this.s.length, b = 0; b < a; b++) {
                        var c = this.s[b].split(":"), d = c[0].replace(/\+/g, " "), e = ["n4"];
                        if (2 <= c.length) {
                            var f;
                            var g = c[1];
                            f = [];
                            if (g)for (var g = g.split(","), h = g.length, m = 0; m < h; m++) {
                                var l;
                                l = g[m];
                                if (l.match(/^[\w-]+$/)) {
                                    l = ta.exec(l.toLowerCase());
                                    var p = void 0;
                                    if (null == l) p = ""; else {
                                        p = void 0;
                                        p = l[1];
                                        if (null == p || "" == p) p = "4"; else var fa = ra[p], p = fa ? fa : isNaN(p) ? "4" : p.substr(0, 1);
                                        l = l[2];
                                        p = [null == l || "" == l ? "n" : sa[l], p].join("")
                                    }
                                    l = p
                                } else l = "";
                                l && f.push(l)
                            }
                            0 < f.length && (e = f);
                            3 == c.length && (c = c[2], f = [], c = c ? c.split(",") : f, 0 < c.length && (c = qa[c[0]]) && (this.M[d] = c))
                        }
                        this.M[d] || (c = qa[d]) && (this.M[d] = c);
                        for (c = 0; c < e.length; c += 1)this.da.push(new H(d, e[c]))
                    }
                };
                function V(a, b) {
                    this.a = (new B(navigator.userAgent)).parse();
                    this.d = a;
                    this.f = b
                }

                var ua = {Arimo: !0, Cousine: !0, Tinos: !0};
                V.prototype.L = function (a, b) {
                    b(a.k.Y)
                };
                V.prototype.load = function (a) {
                    var b = this.d;
                    "MSIE" == this.a.getName() && 1 != this.f.blocking ? ca(b, k(this.aa, this, a)) : this.aa(a)
                };
                V.prototype.aa = function (a) {
                    for (var b = this.d, c = new na(this.f.api, u(b), this.f.text), d = this.f.families, e = d.length, f = 0; f < e; f++) {
                        var g = d[f].split(":");
                        3 == g.length && c.W.push(g.pop());
                        var h = "";
                        2 == g.length && "" != g[1] && (h = ":");
                        c.s.push(g.join(h))
                    }
                    d = new pa(d);
                    d.parse();
                    v(b, c.e());
                    a(d.da, d.M, ua)
                };
                function W(a, b) {
                    this.d = a;
                    this.f = b;
                    this.p = []
                }

                W.prototype.J = function (a) {
                    var b = this.d;
                    return u(this.d) + (this.f.api || "//f.fontdeck.com/s/css/js/") + (b.w.location.hostname || b.K.location.hostname) + "/" + a + ".js"
                };
                W.prototype.L = function (a, b) {
                    var c = this.f.id, d = this.d.w, e = this;
                    c ? (d.__tpwebfontfontdeckmodule__ || (d.__tpwebfontfontdeckmodule__ = {}), d.__tpwebfontfontdeckmodule__[c] = function (a, c) {
                        for (var d = 0, m = c.fonts.length; d < m; ++d) {
                            var l = c.fonts[d];
                            e.p.push(new H(l.name, ga("font-weight:" + l.weight + ";font-style:" + l.style)))
                        }
                        b(a)
                    }, w(this.d, this.J(c), function (a) {
                        a && b(!1)
                    })) : b(!1)
                };
                W.prototype.load = function (a) {
                    a(this.p)
                };
                function X(a, b) {
                    this.d = a;
                    this.f = b;
                    this.p = []
                }

                X.prototype.J = function (a) {
                    var b = u(this.d);
                    return (this.f.api || b + "//use.typekit.net") + "/" + a + ".js"
                };
                X.prototype.L = function (a, b) {
                    var c = this.f.id, d = this.d.w, e = this;
                    c ? w(this.d, this.J(c), function (a) {
                        if (a) b(!1); else {
                            if (d.Typekit && d.Typekit.config && d.Typekit.config.fn) {
                                a = d.Typekit.config.fn;
                                for (var c = 0; c < a.length; c += 2)for (var h = a[c], m = a[c + 1], l = 0; l < m.length; l++)e.p.push(new H(h, m[l]));
                                try {
                                    d.Typekit.load({events: !1, classes: !1})
                                } catch (p) {
                                }
                            }
                            b(!0)
                        }
                    }, 2E3) : b(!1)
                };
                X.prototype.load = function (a) {
                    a(this.p)
                };
                function Y(a, b) {
                    this.d = a;
                    this.f = b;
                    this.p = []
                }

                Y.prototype.L = function (a, b) {
                    var c = this, d = c.f.projectId, e = c.f.version;
                    if (d) {
                        var f = c.d.w;
                        w(this.d, c.J(d, e), function (e) {
                            if (e) b(!1); else {
                                if (f["__mti_fntLst" + d] && (e = f["__mti_fntLst" + d]()))for (var h = 0; h < e.length; h++)c.p.push(new H(e[h].fontfamily));
                                b(a.k.Y)
                            }
                        }).id = "__MonotypeAPIScript__" + d
                    } else b(!1)
                };
                Y.prototype.J = function (a, b) {
                    var c = u(this.d), d = (this.f.api || "fast.fonts.net/jsapi").replace(/^.*http(s?):(\/\/)?/, "");
                    return c + "//" + d + "/" + a + ".js" + (b ? "?v=" + b : "")
                };
                Y.prototype.load = function (a) {
                    a(this.p)
                };
                function Z(a, b) {
                    this.d = a;
                    this.f = b
                }

                Z.prototype.load = function (a) {
                    var b, c, d = this.f.urls || [], e = this.f.families || [], f = this.f.testStrings || {};
                    b = 0;
                    for (c = d.length; b < c; b++)v(this.d, d[b]);
                    d = [];
                    b = 0;
                    for (c = e.length; b < c; b++) {
                        var g = e[b].split(":");
                        if (g[1])for (var h = g[1].split(","), m = 0; m < h.length; m += 1)d.push(new H(g[0], h[m])); else d.push(new H(g[0]))
                    }
                    a(d, f)
                };
                Z.prototype.L = function (a, b) {
                    return b(a.k.Y)
                };
                var $ = new U(this);
                $.B.C.custom = function (a, b) {
                    return new Z(b, a)
                };
                $.B.C.fontdeck = function (a, b) {
                    return new W(b, a)
                };
                $.B.C.monotype = function (a, b) {
                    return new Y(b, a)
                };
                $.B.C.typekit = function (a, b) {
                    return new X(b, a)
                };
                $.B.C.google = function (a, b) {
                    return new V(b, a)
                };
                this.tpWebFont || (this.tpWebFont = {}, this.tpWebFont.load = k($.load, $), this.tpWebFontConfig && $.load(this.tpWebFontConfig));
            })(this, document);


            var sgfamilies = [];
            <?php foreach ($sgfamilies as $sgf): ?>
            sgfamilies.push('<?php echo $sgf ?>');
            <?php endforeach; ?>
            var callAllIdle_LocalTimeOut;
            function fontLoaderWaitForTextLayers() {
                if (jQuery('.slide_layer_type_text').length > 0) {
                    tpLayerTimelinesRev.allLayerToIdle({type: "text"});
                    clearTimeout(callAllIdle_LocalTimeOut);
                    callAllIdle_LocalTimeOut = setTimeout(function () {
                        tpLayerTimelinesRev.allLayerToIdle({type: "text"});
                    }, 1250);
                }
                else
                    setTimeout(fontLoaderWaitForTextLayers, 250);
            }
            document.addEventListener("DOMContentLoaded", function () {
                if (sgfamilies.length) {
                    for (var key in sgfamilies) {
                        var loadnow = [sgfamilies[key]];

                        tpWebFont.load({
                            timeout: 10000,
                            google: {
                                families: loadnow
                            },
                            loading: function (e) {
                            },
                            active: function () {
                                fontLoaderWaitForTextLayers();
                            },
                            inactive: function () {
                                fontLoaderWaitForTextLayers();
                            },
                        });
                    }
                }
            });
        </script>
        <?php
        return ob_get_clean();
    }

    public function slide_selector_html($data)
    {
        $url = $data['url'];
        extract($data['global']);
        ob_start();
        ?>
        <input type="hidden" value="<?php echo $slide_selector['_width'] ?>" name="rs-grid-width"/>
        <input type="hidden" value="<?php echo $slide_selector['_height'] ?>" name="rs-grid-height"/>

        <div id="slide_selector" class="slide_selector editor_buttons_wrapper  postbox unite-postbox"
             style="max-width:100% !important; min-width:1200px !important">
            <div class="inner_wrapper p10 boxsized">
                <ul class="list_slide_links">
                    <li class="<?php echo $slide_selector['staticclass'] ?> eg-drag-disabled">
                        <?php if (!($slide_selector['slide']['isStaticSlide'])) : ?>
                        <a href="<?php echo $url['view']['static_slide'] ?>" class="add_slide">
                            <?php endif; ?>
                            <div class="slide-media-container icon-basketball"
                                 style="border:1px solid #3498DB; border-bottom:none;"></div>
                            <div class="slide-link-content alwaysbluebg"
                                 style="background:#3498DB !important; color:#fff">
                                <span class="slide-link" style="width:100%;text-align: center;">
                                    <?php echo t("Static / Global Layers") ?>
                                </span>
                            </div>
                            <?php if (!($slide_selector['slide']['isStaticSlide'])) : ?>
                        </a>
                    <?php endif; ?>
                        <?php if ($slide_selector['slide']['isStaticSlide']) : ?>
                            <span style="position:absolute; top:13px;left:0px; text-align: center">
							<span class="setting_text_3">
                                <?php echo t("Show Layers from Slide :") ?>
                            </span>
							<select name="rev_show_the_slides">
								<option value="none">---</option>
                                <?php foreach ($slide_selector['all_slides'] as $c_slide): ?>
                                    <option value="<?php echo $c_slide['id'] ?>"><?php echo $c_slide['option_label'] ?></option>
                                <?php endforeach; ?>
							</select>
					    </span>
                        <?php endif; ?>
                    </li>
                    <?php foreach ($slide_selector['arrSlides'] as $t_slide) : ?>
                        <li id="slidelist_item_<?php echo $t_slide['slidelistID'] ?>"
                            class="<?php echo $t_slide['c_topclass'] ?>">
                            <a href="<?php echo $t_slide['urlEditSlide'] ?>" <?php echo $t_slide['addParams'] ?> >
                                <span class="mini-transparent mini-as-bg"></span>
                                <span class="slide-media-container <?php echo $t_slide['c_bg_extraClass'] ?>" <?php echo $t_slide['c_bg_fullstyle'] ?> >
                            </span>
                                <i class="slide-link-forward eg-icon-forward"></i>
                            </a>
                            <span class="slide-link-published-wrapper">
                            <?php if (!($t_slide['the_slidertype'] === 'hero')) { ?>
                                <?php if ($t_slide['c_isvisible'] === "published") {
                                    ?>
                                    <span class="slide-published"></span>
                                    <span class="slide-unpublished pubclickable"></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="slide-unpublished"></span>
                                    <span class="slide-published pubclickable"></span>
                                    <?php
                                } ?>
                            <?php } else { ?>
                                <?php if ($t_slide['active_slide'] === $t_slide['slidelistID'] || $t_slide['active_slide'] === -1) {
                                    ?>
                                    <span class="slide-hero-published"></span>
                                    <?php
                                } else {
                                    ?>
                                    <span class="slide-hero-unpublished pubclickable"></span>
                                    <?php
                                } ?>
                            <?php } //endif; ?>
					</span>

                            <div class="slide-link-content">
						<span class="slide-link">
							<span class="slide-link-nr">#<?php echo $t_slide['slidecounter'] ?></span>
							<input class="slidetitleinput" name="slidetitle"
                                   value="<?php echo $t_slide['title'] ?>"/>
							<span class="slidelint-edit-button"></span>
						</span>
                                <div class="slide-link-toolbar">
                                    <?php if (!($t_slide['slidelistID'] === $slide_selector['slideID']) && $t_slide['is_slide_id_not_in_children_ids']): ?>
                                        <a class="slide-link-toolbar-button slide-moveto" href="#"><span class=""><i
                                                        class="eg-icon-forward"></i>
                                        <span><?php echo t("Copy / Move") ?></span></span>
                                        </a>
                                    <?php endif; ?>
                                    <a class="slide-link-toolbar-button slide-duplicate" href="#">
                                        <span class=""><i
                                                    class="eg-icon-picture"></i><span><?php echo t("Duplicate") ?></span></span>
                                    </a>
                                    <a class="slide-link-toolbar-button slide-remove" href="#">
                                        <span class=""><i
                                                    class="eg-icon-trash"></i><span><?php echo t("Delete") ?></span></span>
                                    </a>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    <li class="eg-drag-disabled">
                        <a href="javascript:void(0);" class="add_slide">
                            <div class="slide-media-container" style="border:1px dashed #ddd; border-bottom:none;">
                                <i style="position:absolute; top:50%;left:50%; font-size:25px; color:#ddd;margin-left:-17px;margin-top:-7px;"
                                   class="eg-icon-plus"></i>
                            </div>
                            <div class="slide-link-content">
                                <span class="slide-link"
                                      style="width:100%;text-align: center;font-weight:600;"><?php echo t("Add Slide") ?></span>
                            </div>
                        </a>
                        <div class="slide-link-content">
                            <div class="slide-link-toolbar">
                                <a id="link_add_slide" href="javascript:void(0);" class="slide-link-toolbar-button">
                            <span class="slide-add"><i class="eg-icon-picture-1" style="margin-right:5px"></i>
                                <span><?php echo t("Add Blank Slide") ?></span>
                            </span>
                                </a>
                                <a id="link_add_bulk_slide" href="javascript:void(0);"
                                   class="slide-link-toolbar-button">
                            <span class="slide-add"><i class="eg-icon-picture" style="margin-right:5px"></i>
                                <span><?php echo t("Add Bulk Slides") ?></span>
                            </span>
                                </a>
                            </div>
                            <span class="slide-link" style="text-align:center">
						<?php echo t("Add Slide") ?>
					</span>
                        </div>
                        <div class="small-triangle-bar"></div>
                    </li>

                    <li>
                        <div id="loader_add_slide" class="loader_round" style="display:none"></div>
                    </li>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function (event) {
                jQuery('.list_slide_links li').each(function () {
                    var li = jQuery(this);

                    li.hover(function () {
                        var li = jQuery(this),
                            tb = li.find('.slide-link-toolbar');
                        li.removeClass("nothovered");
                        tb.show();
                    }, function () {
                        var li = jQuery(this),
                            tb = li.find('.slide-link-toolbar');
                        li.addClass("nothovered");
                        if (!li.hasClass("infocus"))
                            tb.hide();
                    })
                });

                var oldslidetitle = "";

                jQuery('.slidetitleinput').focus(function () {
                    oldslidetitle = jQuery(this).val();
                    jQuery(this).closest("li").addClass("infocus");
                }).blur(function () {
                    jQuery(this).val(oldslidetitle);
                    var li = jQuery(this).closest("li")
                    li.removeClass("infocus");
                    if (li.hasClass("nothovered")) {
                        tb = li.find('.slide-link-toolbar');
                        tb.hide();
                    }
                });

                jQuery('.slidetitleinput').on("change", function () {
                    var titleinp = jQuery(this),
                        slide_title = titleinp.val(),
                        slide_id = jQuery(this).closest('li').attr('id').replace('slidelist_item_', '');

                    oldslidetitle = slide_title;
                    titleinp.blur();
                    if (UniteAdminRev.sanitize_input(slide_title) == '') {
                        alert('<?php echo t("Slide name should not be empty") ?>');
                        return false;
                    }

                    var data = {slideID: slide_id, slideTitle: slide_title};

                    UniteAdminRev.ajaxRequest('change_slide_title', data, function (response) {
                    });

                    if (jQuery(this).closest('li').hasClass('selected')) { //set input field to new value
                        jQuery('input[name="title"]').val(slide_title);
                    }
                })

                jQuery('.slidelint-edit-button').click(function () {
                    var titleinp = jQuery(this).siblings('.slidetitleinput'),
                        slide_title = titleinp.val(),
                        slide_id = jQuery(this).closest('li').attr('id').replace('slidelist_item_', '');

                    oldslidetitle = slide_title;
                    titleinp.blur();
                    if (UniteAdminRev.sanitize_input(slide_title) == '') {
                        alert('<?php echo t("Slide name should not be empty") ?>');
                        return false;
                    }

                    var data = {slideID: slide_id, slideTitle: slide_title};

                    UniteAdminRev.ajaxRequest('change_slide_title', data, function (response) {
                    });

                    if (jQuery(this).closest('li').hasClass('selected')) { //set input field to new value
                        jQuery('input[name="title"]').val(slide_title);
                    }
                });


                // OPEN THE TEMPLATE LIST ON CLICK OF ADD SLIDE TEMPLATE
                jQuery('#rs_copy_slide_from_slider').click(function () {
                    RevSliderAdmin.load_slide_template_html();
                });

            });


        </script>
        <?php
        return ob_get_clean();
    }

    public function breadcrumbs_html($data)
    {
        $url = $data['url'];
        extract($data['global']['breadcrumbs']);
        ob_start();
        ?>
        <div class="rs_breadcrumbs">
            <a class='breadcrumb-button' href='<?php echo $url['view']['sliders'] ?>'>
            <i class="eg-icon-th-large"></i><?php echo t("All Sliders") ?>
            </a>
            <a class='breadcrumb-button' href="<?php echo $url['view']['slider'] ?>">
                <i class="eg-icon-cog"></i><?php echo t('Slider Settings') ?>
            </a>
            <a class='breadcrumb-button selected' href="#">
                <i class="eg-icon-pencil-2"></i><?php echo t('Slide Editor') ?> "<?php echo $slider_title ?>"
            </a>
            <div class="tp-clearfix"></div>
            <!-- FIXED TOOLBAR ON THE RIGHT SIDE -->
            <ul class="rs-mini-toolbar" id="revslider_mini_toolbar">
                <li class="rs-toolbar-savebtn rs-mini-toolbar-button">
                    <a class='button-primary revgreen' href='javascript:void(0)' id="<?php echo $savebtnid ?>" >
                        <i class="rs-icon-save-light" style="display: inline-block;vertical-align: middle;width: 18px;height: 20px;background-repeat: no-repeat;"></i>
                        <span class="mini-toolbar-text"><?php echo t("Save Slide") ?></span>
                    </a>
                </li>
                <li class="rs-toolbar-cssbtn rs-mini-toolbar-button">
                    <a class='button-primary revpurple' href='javascript:void(0)' id='button_edit_css_global'><i class="">&lt;/&gt;</i>
                        <span class="mini-toolbar-text"><?php echo t("Slider CSS/JS") ?></span>
                    </a>
                </li>
                <li class="rs-toolbar-slides rs-mini-toolbar-button">
                    <a class="button-primary revblue" href="<?php echo $url['view']['slider_url'] ?>" id="link_edit_slides_t">
                        <i class="revicon-cog"></i>
                        <span class="mini-toolbar-text"><?php echo t("Slider Settings") ?></span>
                    </a>

                </li>
                <li class="rs-toolbar-preview rs-mini-toolbar-button">
                    <a class="button-primary revgray" href="javascript:void(0)"  id="<?php echo $prevbtn ?>" >
                        <i class="revicon-search-1"></i>
                        <span class="mini-toolbar-text"><?php echo t("Preview") ?></span>
                    </a>
                </li>

            </ul>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function(event) {
                jQuery('.rs-mini-toolbar-button').hover(function() {
                    var btn=jQuery(this),
                        txt = btn.find('.mini-toolbar-text');
                    punchgs.TweenLite.to(txt,0.2,{width:"100px",ease:punchgs.Linear.easeNone,overwrite:"all"});
                    punchgs.TweenLite.to(txt,0.1,{autoAlpha:1,ease:punchgs.Linear.easeNone,delay:0.1,overwrite:"opacity"});
                }, function() {
                    var btn=jQuery(this),
                        txt = btn.find('.mini-toolbar-text');
                    punchgs.TweenLite.to(txt,0.2,{autoAlpha:0,width:"0px",ease:punchgs.Linear.easeNone,overwrite:"all"});
                });
                var mtb = jQuery('.rs-mini-toolbar'),
                    mtbo = mtb.offset().top;
                function checkStickyToolBar() {
                    if (mtbo-jQuery(window).scrollTop()<35) {
                        mtb.addClass("sticky");
                        jQuery('#wp-admin-bar-my-account').css({paddingRight:"180px"});
                    }
                    else {
                        mtb.removeClass("sticky");
                        jQuery('#wp-admin-bar-my-account').css({paddingRight:"0px"});
                    }
                }
                checkStickyToolBar();
                jQuery(document).on("scroll",checkStickyToolBar);
            });
        </script>
        <?php
        return ob_get_clean();
    }

    public function slide_general_settings_html($data)
    {
        extract($data['global']['slide_general_settings']);
        ob_start();
        ?>
        <!-- THE CONTEXT MENU -->
        <div id="context_menu_underlay" class="ignorecontextmenu"></div>
        <nav id="context-menu" class="context-menu">
            <ul id="context-menu-first-ul" class="context-menu__items">
                <!-- CURRENT LAYER -->
                <li class="context-menu__item not_in_ctx_bg" id="ctx-m-activelayer">
                    <div class="ctx_item_inner"><i id="cx-selected-layer-icon" class="rs-icon-layerimage_n context-menu__link"
                                                   data-action="nothing"></i><span
                                id="cx-selected-layer-name"><?php echo t("Black Canon DSLR") ?></span>
                        <span data-uniqueid="4" id="ctx-list-of-layer-links" class="ctx-list-of-layer-links">
    		<span id="ctx-layer-link-type-element-cs"
                  class="ctx-layer-link-type-element ctx-layer-link-type-element-cs ctx-layer-link-type-3"></span>
    		<span class="ctx-list-of-layer-links-inner">
    			<span data-linktype="1" data-action="grouplinkchange"
                      class="context-menu__link ctx-layer-link-type-element ctx-layer-link-type-1"></span>
    			<span data-linktype="2" data-action="grouplinkchange"
                      class="context-menu__link ctx-layer-link-type-element ctx-layer-link-type-2"></span>
    			<span data-linktype="3" data-action="grouplinkchange"
                      class="context-menu__link ctx-layer-link-type-element ctx-layer-link-type-3"></span>
    			<span data-linktype="4" data-action="grouplinkchange"
                      class="context-menu__link ctx-layer-link-type-element ctx-layer-link-type-4"></span>
    			<span data-linktype="5" data-action="grouplinkchange"
                      class="context-menu__link ctx-layer-link-type-element ctx-layer-link-type-5"></span>
    			<span data-linktype="0" data-action="grouplinkchange"
                      class="context-menu__link ctx-layer-link-type-element ctx-layer-link-type-0"></span>
    		</span>
    	</span>
                    </div>
                </li>
                <!-- BACKGROUND CONTEXT - ADD LAYER -->
                <li class="context-menu__item context-with-sub not_in_ctx_layer">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link"><i class="rs-icon-addlayer2"></i><span
                                    class="cx-layer-name"><?php echo t("Add Layer") ?></span></div>
                        <i class="fa-icon-chevron-right"></i></div>
                    <ul class="context-submenu">
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="addtextlayer"><i
                                            class="rs-icon-layerfont_n"></i><span
                                            class="cx-layer-name"><?php echo t("Add Text/Html Layer") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="addimagelayer"><i class="rs-icon-layerimage_n"></i><span
                                            class="cx-layer-name"><?php echo t("Add Image Layer") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="addaudiolayer"><i class="rs-icon-layeraudio_n"></i><span
                                            class="cx-layer-name"><?php echo t("Add Audio Layer") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="addvideolayer"><i class="rs-icon-layervideo_n"></i><span
                                            class="cx-layer-name"><?php echo t("Add Video Layer") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="addbuttonlayer"><i
                                            class="rs-icon-layerbutton_n"></i><span
                                            class="cx-layer-name"><?php echo t("Add Button Layer") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="addshapelayer"><i class="rs-icon-layershape_n"></i><span
                                            class="cx-layer-name"><?php echo t("Add Shape Layer") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="addobjectlayer"><i
                                            class="rs-icon-layersvg_n"></i><span
                                            class="cx-layer-name"><?php echo t("Add Object Layer") ?></span></div>
                            </div>
                        </li>


                    </ul>
                </li>
                <!-- ALL LAYERS -->
                <li class="context-menu__item ctx-m-top-divider context-with-sub" id="ctx-select-layer">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link" data-action="select layer"><i class="eg-icon-menu"></i><span
                                    class="cx-layer-name"><?php echo t("Select Layer") ?></span></div>
                        <i class="fa-icon-chevron-right"></i></div>
                    <ul class="context-submenu" id="ctx_list_of_layers">

                    </ul>
                </li>
                <!-- LAYER MANIPULATION -->
                <li class="context-menu__item not_in_ctx_bg">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link" data-action="delete"><i class="rs-lighttrash"></i><span
                                    class="cx-layer-name"><?php echo t("Delete Layer") ?></span></div>
                    </div>
                </li>

                <li class="context-menu__item not_in_ctx_bg">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link" data-action="duplicate"><i class="rs-lightcopy"></i><span
                                    class="cx-layer-name"><?php echo t("Duplicate Layer") ?></span></div>
                    </div>
                </li>
                <!-- LAYER VISIBILTY AND LOCK -->
                <li class="context-menu__item ctx-m-top-divider context-with-sub">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link"><i class="eg-icon-eye"></i><span
                                    class="cx-layer-name"><?php echo t("Show Layers") ?></span></div>
                        <i class="fa-icon-chevron-right"></i></div>
                    <ul class="context-submenu" id="ctx_list_of_invisibles">
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="showalllayer"><i class="fa-icon-asterisk"></i><span
                                            class="cx-layer-name"><?php echo t("Show All Layers") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="showonlycurrent"><i
                                            class="fa-icon-hand-o-right"></i><span
                                            class="cx-layer-name"><?php echo t("Show Only Current Layer") ?></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="context-menu__item not_in_ctx_bg" id="cx-selected-layer-visible">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link" data-action="showhide"><i class="eg-icon-eye-off"></i><span
                                    class="cx-layer-name"><?php echo t("Hide Layer") ?></span></div>
                    </div>
                </li>

                <li class="context-menu__item not_in_ctx_bg" id="cx-selected-layer-locked">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link" data-action="lockunlock"><i class="eg-icon-lock-open"></i><span
                                    class="cx-layer-name"><?php echo t("Lock Layer") ?></span></div>
                    </div>
                </li>

                <!-- LAYER SPECIALS -->
                <!-- STYLE OF LAYERS -->
                <li class="context-menu__item ctx-m-top-divider context-with-sub not_in_ctx_bg">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link"><i class="fa-icon-paint-brush"></i><span
                                    class="cx-layer-name"><?php echo t("Style") ?></span></div>
                        <i class="fa-icon-chevron-right"></i></div>
                    <ul class="context-submenu">
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="copystyle"><i class="fa-icon-cut"></i><span
                                            class="cx-layer-name"><?php echo t("Copy Style") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="pastestyle"><i class="fa-icon-edit"></i><span
                                            class="cx-layer-name"><?php echo t("Paste Style") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div style="display:inline-block" class="context-menu__link" data-action="nothing"><i
                                            class="fa-icon-edit"></i><span
                                            class="cx-layer-name"><?php echo t("Inherit Style from") ?></span></div>
                                <div style="display:inline-block; float:right; margin-top:3px; height:20px"
                                     data-action="nothing">
                                    <div id="ctx-inheritdesktop" class="ctx-in-one-row context-menu__link" data-size="desktop"
                                         data-action="inheritfromdesktop"><i style="width:19px; margin:0;"
                                                                             class="rs-displays-icon rs-slide-ds-desktop"></i>
                                    </div>
                                    <div id="ctx-inheritnotebook" class="ctx-in-one-row context-menu__link" data-size="notebook"
                                         data-action="inheritfromnotebook"><i style="width:26px; margin:0;"
                                                                              class="rs-displays-icon rs-slide-ds-notebook"></i>
                                    </div>
                                    <div id="ctx-inherittablet" class="ctx-in-one-row context-menu__link" data-size="tablet"
                                         data-action="inheritfromtablet"><i style="width:15px; margin:0;"
                                                                            class="rs-displays-icon rs-slide-ds-tablet"></i>
                                    </div>
                                    <div id="ctx-inheritmobile" class="ctx-in-one-row context-menu__link" data-size="mobile"
                                         data-action="inheritfrommobile"><i style="width:17px; margin:0;"
                                                                            class="rs-displays-icon rs-slide-ds-mobile"></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="advancedcss"><i class="fa-icon-code"></i><span
                                            class="cx-layer-name"><?php echo t("Advanced Layer CSS") ?></span></div>
                            </div>
                        </li>
                        <li class="context-menu__item ctx-m-top-divider _ho_image _ho_group _ho_row _ho_column _ho_svg _ho_audio _ho_video _ho_group _ho_shape _ho_button">
                            <div class="ctx_item_inner context-menu__link noleftmargin" data-action="delegate"
                                 data-delegate="ctx_linebreak"><i class="fa-icon-level-down"></i><span
                                        class="cx-layer-name"><?php echo t("Line Break") ?></span>
                                <div id="ctx_linebreak" class="ctx-td-switcher context-menu__link"
                                     data-action="linebreak"></div>
                            </div>
                        </li>
                        <li class="context-menu__item _ho_image _ho_group _ho_row _ho_column _ho_svg _ho_audio _ho_video _ho_group _ho_notincolumn">
                            <div class="ctx_item_inner context-menu__link noleftmargin" data-action="nothing"><i
                                        class="fa-icon-text-width"></i><span
                                        class="cx-layer-name"><?php echo t("Display Mode") ?></span>
                                <div class="context-menu__link ctx-td-option-selector-wrapper" data-action="nothing">
                                    <div id="ctx_displayblock" class="ctx-td-option-selector context-menu__link selected"
                                         data-action="displayblock">Block
                                    </div>
                                    <div id="ctx_displayinline" class="ctx-td-option-selector context-menu__link"
                                         data-action="displayinline">Inline
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="context-menu__item ctx-m-top-divider _ho_text  _ho_row _ho_column _ho_audio _ho_shape _ho_button">
                            <div class="ctx_item_inner context-menu__link noleftmargin" data-action="delegate"
                                 data-delegate="ctx_keepaspect"><i class="fa-icon-expand"></i><span
                                        class="cx-layer-name"><?php echo t("Keep Aspect Ratio") ?></span>
                                <div id="ctx_keepaspect" class="ctx-td-switcher context-menu__link"
                                     data-action="aspectratio"></div>
                            </div>
                        </li>
                        <li class="context-menu__item _ho_text _ho_group _ho_row _ho_column _ho_audio _ho_video _ho_shape _ho_button">
                            <div class="ctx_item_inner">
                                <div class="context-menu__link" data-action="resetsize"><i class="fa-icon-rotate-left"></i><span
                                            class="cx-layer-name"><?php echo t("Reset Size") ?></span></div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- RESPONSIVENESS -->
                <li class="context-menu__item context-with-sub not_in_ctx_bg">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link"><i class="fa-icon-compress"></i><span
                                    class="cx-layer-name"><?php echo t("Layer Responsiveness") ?></span></div>
                        <i class="fa-icon-chevron-right"></i></div>
                    <ul class="context-submenu">
                        <li class="context-menu__item">
                            <div class="ctx_item_inner context-menu__link" data-action="nothing"><span
                                        class="cx-layer-name"><?php echo t("Alignment") ?></span>
                                <div class="context-menu__link ctx-td-option-selector-wrapper" data-action="nothing">
                                    <div id="ctx_gridbased" class="ctx-td-option-selector context-menu__link selected"
                                         data-action="gridbased">Grid Based
                                    </div>
                                    <div id="ctx_slidebased" class="ctx-td-option-selector context-menu__link"
                                         data-action="slidebased">Slide Based
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="context-menu__item _ho_row _ho_column">
                            <div class="ctx_item_inner context-menu__link" data-action="delegate"
                                 data-delegate="ctx_autoresponsive"><span
                                        class="cx-layer-name"><?php echo t("Auto Responsive") ?></span>
                                <div id="ctx_autoresponsive" class="ctx-td-switcher context-menu__link"
                                     data-action="autoresponsive"></div>
                            </div>
                        </li>
                        <li class="context-menu__item _ho_row _ho_column">
                            <div class="ctx_item_inner context-menu__link" data-action="delegate"
                                 data-delegate="ctx_childrenresponsive"><span
                                        class="cx-layer-name"><?php echo t("Children Responsive") ?></span>
                                <div id="ctx_childrenresponsive" class="ctx-td-switcher context-menu__link"
                                     data-action="childrenresponsive"></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner context-menu__link" data-action="delegate"
                                 data-delegate="ctx_responsiveoffset"><span
                                        class="cx-layer-name"><?php echo t("Responsive Offset") ?></span>
                                <div id="ctx_responsiveoffset" class="ctx-td-switcher context-menu__link"
                                     data-action="responsiveoffset"></div>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- VISIBILITY -->
                <li class="context-menu__item context-with-sub not_in_ctx_bg">
                    <div class="ctx_item_inner">
                        <div class="context-menu__link"><i class="fa-icon-eye"></i><span
                                    class="cx-layer-name"><?php echo t("Visibility") ?></span></div>
                        <i class="fa-icon-chevron-right"></i></div>
                    <ul class="context-submenu">
                        <li class="context-menu__item">
                            <div class="ctx_item_inner context-menu__link noleftmargin" data-action="delegate"
                                 data-delegate="ctx_showhideondesktop"><i class="rs-displays-icon rs-slide-ds-desktop"></i><span
                                        class="cx-layer-name"><?php echo t("Desktop") ?></span>
                                <div id="ctx_showhideondesktop" class="ctx-td-switcher context-menu__link"
                                     data-action="showhideondesktop"></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner context-menu__link noleftmargin" data-action="delegate"
                                 data-delegate="ctx_showhideonnotebook"><i
                                        class="rs-displays-icon rs-slide-ds-notebook"></i><span
                                        class="cx-layer-name"><?php echo t("Notebook") ?></span>
                                <div id="ctx_showhideonnotebook" class="ctx-td-switcher context-menu__link"
                                     data-action="showhideonnotebook"></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner context-menu__link noleftmargin" data-action="delegate"
                                 data-delegate="ctx_showhideontablet"><i class="rs-displays-icon rs-slide-ds-tablet"></i><span
                                        class="cx-layer-name"><?php echo t("Tablet") ?></span>
                                <div id="ctx_showhideontablet" class="ctx-td-switcher context-menu__link"
                                     data-action="showhideontablet"></div>
                            </div>
                        </li>
                        <li class="context-menu__item">
                            <div class="ctx_item_inner context-menu__link noleftmargin" data-action="delegate"
                                 data-delegate="ctx_showhideonmobile"><i class="rs-displays-icon rs-slide-ds-mobile"></i><span
                                        class="cx-layer-name"><?php echo t("Mobile") ?></span>
                                <div id="ctx_showhideonmobile" class="ctx-td-switcher context-menu__link"
                                     data-action="showhideonmobile"></div>
                            </div>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>


        <div id="slide_main_settings_wrapper" class="editor_buttons_wrapper  postbox unite-postbox">
            <div class="box-closed tp-accordion" style="border-bottom:5px solid #ddd;">
                <ul class="rs-slide-settings-tabs">
                    <?php if(!$slide['isStaticSlide']) : ?>
                    <li id="v_sgs_mp_1" data-content="#slide-main-image-settings-content" class="selected"><i
                                style="height:45px"
                                class="rs-mini-layer-icon eg-icon-picture-1 rs-toolbar-icon"></i><span><?php echo t("Main Background") ?></span>
                    </li>
                    <?php endif; ?>
                    <li id="v_sgs_mp_2" class="<?php echo $slide['isStaticSlide'] ? ' selected' : '' ?>"
                        data-content="#slide-general-settings-content"><i style="height:45px"
                                                                          class="rs-mini-layer-icon rs-icon-chooser-2 rs-toolbar-icon"></i><?php echo t("General Settings") ?>
                    </li>
                    <?php if(!$slide['isStaticSlide']) : ?>
                    <li id="v_sgs_mp_3" data-content="#slide-thumbnail-settings-content">
                        <i style="height:45px" class="rs-mini-layer-icon eg-icon-flickr-1 rs-toolbar-icon"></i><?php echo t("Thumbnail") ?>
                    </li>
                    <li id="v_sgs_mp_4" data-content="#slide-animation-settings-content" id="slide-animation-settings-content-tab">
                        <i style="height:45px"  class="rs-mini-layer-icon rs-icon-chooser-3 rs-toolbar-icon"></i><?php echo t("Slide Animation") ?>
                    </li>
                    <li id="v_sgs_mp_5" data-content="#slide-seo-settings-content">
                        <i style="height:45px" class="rs-mini-layer-icon rs-icon-advanced rs-toolbar-icon"></i><?php echo t("Link & Seo") ?>
                    </li>
                    <li id="v_sgs_mp_6" data-content="#slide-info-settings-content">
                        <i style="height:45px; font-size:16px;" class="rs-mini-layer-icon eg-icon-info-circled rs-toolbar-icon"></i><?php echo t("Slide Info") ?>
                    </li>
                    <li id="main-menu-nav-settings-li" data-content="#slide-nav-settings-content">
                        <i  style="height:45px; font-size:16px;" class="rs-mini-layer-icon eg-icon-magic rs-toolbar-icon"></i><?php echo t("Nav. Overwrite") ?>
                    </li>
                    <?php endif ?>
                </ul>

                <div style="clear:both"></div>
                <script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function () {
                        jQuery('.rs-slide-settings-tabs li').click(function () {
                            var tw = jQuery('.rs-slide-settings-tabs .selected'),
                                tn = jQuery(this);
                            jQuery(tw.data('content')).hide(0);
                            tw.removeClass("selected");
                            tn.addClass("selected");
                            jQuery(tn.data('content')).show(0);
                        });
                    });
                </script>
            </div>
            <div style="padding:15px">
                <form name="form_slide_params" id="form_slide_params" class="slide-main-settings-form">
                    <?php if(!$slide['isStaticSlide']) : ?>
                    <div id="slide-main-image-settings-content" class="slide-main-settings-form">

                        <ul class="rs-layer-main-image-tabs" style="display:inline-block; ">
                            <li data-content="#mainbg-sub-source" class="selected"><?php echo t("Source") ?></li>
                            <li class="mainbg-sub-settings-selector"
                                data-content="#mainbg-sub-setting"><?php echo t("Source Settings") ?></li>
                            <li class="mainbg-sub-filtres-selector"
                                data-content="#mainbg-sub-filters"><?php echo t("Filters") ?></li>
                            <li class="mainbg-sub-parallax-selector"
                                data-content="#mainbg-sub-parallax"><?php echo t("Parallax / 3D") ?></li>
                            <li class="mainbg-sub-kenburns-selector"
                                data-content="#mainbg-sub-kenburns"><?php echo t("Ken Burns") ?></li>
                        </ul>

                        <div class="tp-clearfix"></div>

                        <script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function () {
                                jQuery('.rs-layer-main-image-tabs li').click(function () {
                                    var tw = jQuery('.rs-layer-main-image-tabs .selected'),
                                        tn = jQuery(this);
                                    jQuery(tw.data('content')).hide(0);
                                    tw.removeClass("selected");
                                    tn.addClass("selected");
                                    jQuery(tn.data('content')).show(0);
                                });
                            });
                        </script>


                        <!-- SLIDE MAIN IMAGE -->
                        <span id="mainbg-sub-source" style="display:block">
                        <input type="hidden" name="rs-gallery-type" value="<?php echo $slider_type ?>"/>
						<span class="diblock bg-settings-block">
							<!-- IMAGE FROM MEDIAGALLERY -->
                            <?php if($slider_type === 'posts' || $slider_type === 'specific_posts' || $slider_type === 'current_post' || $slider_type === 'woocommerce') {?>
                                <label><?php echo t("Featured Image") ?></label>
                                <input type="radio" name="background_type" value="image" class="bgsrcchanger"
                                       data-callid="tp-bgimagewpsrc" data-imgsettings="on" data-bgtype="image"
                                       id="radio_back_image" <?php echo ( $bgType === 'image') ? 'checked="checked"' : '' ?>>
                            <?php } elseif($slider_type !== 'gallery') { ?>
                                <label><?php echo t("Stream Image") ?></label>
                                <input type="radio" name="background_type" value="image" class="bgsrcchanger"
                                       data-callid="tp-bgimagewpsrc" data-imgsettings="on" data-bgtype="image"
                                       id="radio_back_image" <?php echo ( $bgType == 'image') ? 'checked="checked"' : '' ?>>
                                 <?php if($slider_type === 'vimeo' || $slider_type === 'youtube' || $slider_type === 'instagram' || $slider_type === 'twitter'): ?>
                                    <div class="tp-clearfix"></div>
                                    <label><?php echo t("Stream Video") ?></label>
                                    <input type="radio" name="background_type"
                                           value="stream<?php echo $slider_type ?>"
                                           class="bgsrcchanger" data-callid="tp-bgimagewpsrc" data-imgsettings="on"
                                           data-bgtype="stream<?php echo $slider_type ?>" <?php echo ( $bgType === 'stream'.$slider_type) ? 'checked="checked"' : '' ?>>
                                    <span id="streamvideo_cover" class="streamvideo_cover"
                                          style="display:none;margin-left:20px;">
										<span style="margin-right: 10px"><?php echo t("Use Cover") ?></span>
										<input type="checkbox" class="tp-moderncheckbox" id="stream_do_cover"
                                               name="stream_do_cover"
                                               data-unchecked="off" <?php echo ( $stream_do_cover === 'on') ? 'checked="checked"' : '' ?>>
									</span>

                                    <div class="tp-clearfix"></div>
                                    <label><?php echo t("Stream Video + Image") ?></label>
                                    <input type="radio" name="background_type"
                                           value="stream<?php echo $slider_type ?>both" class="bgsrcchanger"
                                           data-callid="tp-bgimagewpsrc" data-imgsettings="on"
                                           data-bgtype="stream<?php echo $slider_type ?>both" <?php echo ( $bgType == 'stream'.$slider_type.'both') ? 'checked="checked"' : '' ?>>
                                    <span id="streamvideo_cover_both" class="streamvideo_cover_both"
                                          style="display:none;margin-left:20px;">
										<span style="margin-right: 10px"><?php echo t("Use Cover") ?></span>
										<input type="checkbox" class="tp-moderncheckbox" id="stream_do_cover_both"
                                               name="stream_do_cover_both"
                                               data-unchecked="off" <?php echo ( $stream_do_cover_both == 'on') ? 'checked="checked"' : '' ?>>
									</span>
                                <?php endif; ?>
                            <?php } else { ?>
                                <label><?php echo t("Main / Background Image") ?></label>
                                <input type="radio" name="background_type" value="image" class="bgsrcchanger"
                                       data-callid="tp-bgimagewpsrc" data-imgsettings="on" data-bgtype="image"
                                       id="radio_back_image" <?php echo ( $bgType == 'image') ? 'checked="checked"' : '' ?>>
                            <?php } ?>
                            <!-- THE BG IMAGE CHANGED DIV -->
							<span id="tp-bgimagewpsrc" class="bgsrcchanger-div" style="display:none;margin-left:20px;">
								<a href="javascript:void(0)" id="button_change_image" class="button-primary revblue"><i
                                            class="fa-icon-drupal"></i><?php echo t("Media Library") ?></a>
							</span>

							</span>
							<div class="tp-clearfix"></div>

                            <!-- IMAGE FROM EXTERNAL -->
							<label><?php echo t("External URL") ?></label>
							<input type="radio" name="background_type" value="external" data-callid="tp-bgimageextsrc"
                                   data-imgsettings="on" class="bgsrcchanger" data-bgtype="external"
                                   id="radio_back_external" <?php echo ( $bgType == 'external') ? 'checked="checked"' : '' ?>>

                            <!-- THE BG IMAGE FROM EXTERNAL SOURCE -->
							<span id="tp-bgimageextsrc" class="bgsrcchanger-div" style="display:none;margin-left:20px;">
								<input type="text" name="bg_external" id="slide_bg_external"
                                       value="<?php echo $slideBGExternal ?>"
                                       <?php echo !( $bgType == 'external') ? ' class="disabled"' : '' ?>>
								<a href="javascript:void(0)" id="button_change_external"
                                   class="button-primary revblue"><?php echo t("Get External") ?></a>
							</span>

							<div class="tp-clearfix"></div>

                            <!-- TRANSPARENT BACKGROUND -->
							<label><?php echo t("Transparent") ?></label>
							<input type="radio" name="background_type" value="trans" data-callid="" class="bgsrcchanger"
                                   data-bgtype="trans"
                                   id="radio_back_trans" <?php echo ( $bgType == 'trans') ? 'checked="checked"' : '' ?>>
							<div class="tp-clearfix"></div>

                            <!-- COLORED BACKGROUND -->
							<label><?php echo t("Colored") ?></label>
							<input type="radio" name="background_type" value="solid" data-callid="tp-bgcolorsrc"
                                   class="bgsrcchanger" data-bgtype="solid"
                                   id="radio_back_solid" <?php echo ( $bgType == 'solid') ? 'checked="checked"' : '' ?>>

                            <!-- THE COLOR SELECTOR -->
							<span id="tp-bgcolorsrc" class="bgsrcchanger-div" style="display:none;margin-left:20px;">
								<input type="text" data-editing="Background Color" name="bg_color" id="slide_bg_color"
                                       class="my-color-field"
                                       value="<?php echo $slideBGColor ?>">
							</span>
							<div class="tp-clearfix"></div>

                            <!-- THE YOUTUBE SELECTOR -->
							<label id="label_radio_back_youtube"><?php echo t("YouTube Video") ?></label>
							<input type="radio" name="background_type" value="youtube" data-callid="tp-bgyoutubesrc"
                                   class="bgsrcchanger" data-bgtype="youtube"
                                   id="radio_back_youtube" <?php echo ( $bgType == 'youtube') ? 'checked="checked"' : '' ?>>
							<div class="tp-clearfix"></div>

                            <!-- THE BG IMAGE FROM YOUTUBE SOURCE -->
							<span id="tp-bgyoutubesrc" class="bgsrcchanger-div" style="display:none; margin-left:20px;">
								<label style="min-width:180px"><?php echo t("ID:") ?></label>
								<input type="text" name="slide_bg_youtube" id="slide_bg_youtube"
                                       value="<?php echo $slideBGYoutube ?>"
                                       <?php echo !( $bgType == 'youtube') ? ' class="disabled"' : '' ?>>
                                <?php echo t("example: T8--OggjJKQ") ?>
                                <div class="tp-clearfix"></div>
								<label style="min-width:180px"><?php echo t("Cover Image:") ?></label>
								<span id="youtube-image-picker"><a href="javascript:void(0)" id="button_change_image_yt"
                                                                   class="button-primary revgreen"><i
                                                class="fa-icon-photo"></i><?php echo t("YouTube Video Poster") ?></a></span>
							</span>
							<div class="tp-clearfix"></div>

                            <!-- THE VIMEO SELECTOR -->
							<label id="label_radio_back_vimeo"><?php echo t("Vimeo Video") ?></label>
							<input type="radio" name="background_type" value="vimeo" data-callid="tp-bgvimeosrc"
                                   class="bgsrcchanger" data-bgtype="vimeo"
                                   id="radio_back_vimeo" <?php echo ( $bgType == 'vimeo') ? 'checked="checked"' : '' ?>>
							<div class="tp-clearfix"></div>

                            <!-- THE BG IMAGE FROM VIMEO SOURCE -->
							<span id="tp-bgvimeosrc" class="bgsrcchanger-div" style="display:none; margin-left:20px;">
								<label style="min-width:180px"><?php echo t("ID:") ?></label>
								<input type="text" name="slide_bg_vimeo" id="slide_bg_vimeo"
                                       value="<?php echo $slideBGVimeo ?>"
                                       <?php echo !( $bgType == 'vimeo') ? ' class="disabled"' : '' ?>>
                                <?php echo t("example: 30300114") ?>
                                <div class="tp-clearfix"></div>
								<label style="min-width:180px"><?php echo t("Cover Image:") ?></label>
								<span id="vimeo-image-picker"></span>
							</span>
							<div class="tp-clearfix"></div>

                            <!-- THE HTML5 SELECTOR -->
							<label><?php echo t("HTML5 Video") ?></label>
							<input type="radio" name="background_type" value="html5" data-callid="tp-bghtmlvideo"
                                   class="bgsrcchanger" data-bgtype="html5"
                                   id="radio_back_htmlvideo" <?php echo ( $bgType == 'html5') ? 'checked="checked"' : '' ?>>
							<div class="tp-clearfix"></div>
                            <!-- THE BG IMAGE FROM HTML5 SOURCE -->
							<span id="tp-bghtmlvideo" class="bgsrcchanger-div" style="display:none; margin-left:20px;">

								<label style="min-width:180px"><?php echo t("MPEG:") ?></label>
								<input type="text" name="slide_bg_html_mpeg" id="slide_bg_html_mpeg"
                                       value="<?php echo $slideBGhtmlmpeg  ?>"
                                       <?php echo !( $bgType == 'html5') ? ' class="disabled"' : '' ?>>
								<span class="vidsrcchanger-div" style="margin-left:20px;">
									<a href="javascript:void(0)" data-inptarget="slide_bg_html_mpeg"
                                       class="button_change_video button-primary revblue"><?php echo t("Change Video") ?></a>
								</span>
								<div class="tp-clearfix"></div>
								<label style="min-width:180px"><?php echo t("WEBM:") ?></label>
								<input type="text" name="slide_bg_html_webm" id="slide_bg_html_webm"
                                       value="<?php echo $slideBGhtmlwebm  ?>"
                                       <?php echo !( $bgType == 'html5') ? ' class="disabled"' : '' ?>>
								<span class="vidsrcchanger-div" style="margin-left:20px;">
									<a href="javascript:void(0)" data-inptarget="slide_bg_html_webm"
                                       class="button_change_video button-primary revblue"><?php echo t("Change Video") ?></a>
								</span>
								<div class="tp-clearfix"></div>
								<label style="min-width:180px"><?php echo t("OGV:") ?></label>
								<input type="text" name="slide_bg_html_ogv" id="slide_bg_html_ogv"
                                       value="<?php echo $slideBGhtmlogv  ?>"
                                       <?php echo !( $bgType == 'html5') ? ' class="disabled"' : '' ?>>
								<span class="vidsrcchanger-div" style="margin-left:20px;">
									<a href="javascript:void(0)" data-inptarget="slide_bg_html_ogv"
                                       class="button_change_video button-primary revblue"><?php echo t("Change Video") ?></a>
								</span>
								<div class="tp-clearfix"></div>
								<label style="min-width:180px"><?php echo t("Cover Image:") ?></label>
								<span id="html5video-image-picker"></span>
							</span>
						</span>
                        </span>
                        <div id="mainbg-sub-setting" style="display:none">
                            <div style="float:none; clear:both; margin-bottom: 10px;"></div>
                            <div class="rs-img-source-url">
                                <label><?php echo t("Source Info:") ?></label>
                                <span class="text-selectable" id="the_image_source_url" style="margin-right:20px"></span>
                                <span class="description"><?php echo t("Read Only ! Image can be changed from \"Source Tab\"") ?></span>
                            </div>

                            <div class="rs-img-source-size">

                                <label><?php echo t("Image Source Size:") ?></label>
                                <span style="margin-right:20px">
								<select name="image_source_type">
								<?php foreach ($img_sizes as $img_size) : ?>
                                        <option value="<?php echo $img_size['imghandle_val'] ?>" 
                                        <?php echo ($bg_image_size === $img_size['imghandle'])? ' selected="selected"' : '' ?>>
                                            <?php echo $img_size['imgSize'] ?></option>
                                    <?php endforeach; ?>
								</select>
							</span>
                            </div>

                            <div id="tp-bgimagesettings" class="bgsrcchanger-div" style="display:none;">
                                <!-- ALT -->
                                <div>
                                    <label><?php echo t("Alt:") ?></label>
                                    <select id="alt_option" name="alt_option">
                                        <option value="media_library" <?php echo ($alt_option == 'media_library') ? ' selected="selected"' : '' ?>><?php echo t("From Media Library") ?></option>
                                        <option value="file_name" <?php echo ($alt_option == 'file_name') ? ' selected="selected"' : '' ?>><?php echo t("From Filename") ?></option>
                                        <option value="custom" <?php echo ($alt_option == 'custom') ? ' selected="selected"' : '' ?>><?php echo t("Custom") ?></option>
                                    </select>
                                    <input style="<?php echo !($alt_option == 'custom') ? 'display:none;' : '' ?>"
                                           type="text" id="alt_attr" name="alt_attr"
                                           value="<?php echo $alt_attr  ?>><?php echo t("From Media Library") ?>">
                                </div>
                                <div class="ext_setting" style="display: none;">
                                    <label><?php echo t("Width:")  ?></label>
                                    <input type="text" name="ext_width"
                                           value="<?php echo $ext_width  ?>"/>
                                </div>
                                <div class="ext_setting" style="display: none;">
                                    <label><?php echo t("Height:")  ?></label>
                                    <input type="text" name="ext_height"
                                           value="<?php echo $ext_width  ?>"/>
                                </div>

                                <!-- TITLE -->
                                <div>
                                    <label><?php echo t("Title:") ?></label>
                                    <select id="title_option" name="title_option">
                                        <option value="media_library" <?php echo  ($title_option == 'media_library') ? ' selected="selected"' : '' ?>>
                                        <?php echo t("From Media Library") ?></option>
                                        <option value="file_name" <?php echo  ($title_option == 'file_name') ? ' selected="selected"' : '' ?>>
                                        <?php echo t("From Filename") ?></option>
                                        <option value="custom" <?php echo  ($title_option == 'custom') ? ' selected="selected"' : '' ?>>
                                        <?php echo t("Custom") ?></option>
                                    </select>
                                    <input style="<?php echo !($title_option == 'custom') ? 'display:none;' : '' ?>"
                                           type="text" id="title_attr" name="title_attr"
                                           value="<?php echo $title_attr  ?>">
                                </div>
                            </div>

                            <div id="video-settings" style="display: block;">
                                <div>
                                    <label for="video_force_cover"
                                           class="video-label"><?php echo t("Force Cover:") ?></label>
                                    <input type="checkbox" class="tp-moderncheckbox" id="video_force_cover"
                                           name="video_force_cover"
                                           data-unchecked="off" <?php echo ($video_force_cover == 'on') ? ' checked="checked"' : '' ?>>
                                </div>
                                <span id="video_dotted_overlay_wrap">
								<label for="video_dotted_overlay">
									<?php echo t("Dotted Overlay:") ?>
								</label>
								<select id="video_dotted_overlay" name="video_dotted_overlay" style="width:100px">
                                    <option <?php echo  ($video_dotted_overlay == 'none') ? ' selected="selected"' : '' ?>
                                            value="none"><?php echo t("none") ?></option>
                                    <option <?php echo  ($video_dotted_overlay == 'twoxtwo') ? ' selected="selected"' : '' ?>
                                            value="twoxtwo"><?php echo t("2 x 2 Black") ?></option>
                                    <option <?php echo  ($video_dotted_overlay == 'twoxtwowhite') ? ' selected="selected"' : '' ?>
                                            value="twoxtwowhite"><?php echo t("2 x 2 White") ?></option>
                                    <option <?php echo  ($video_dotted_overlay == 'threexthree') ? ' selected="selected"' : '' ?>
                                            value="threexthree"><?php echo t("3 x 3 Black") ?></option>
                                    <option <?php echo  ($video_dotted_overlay == 'threexthreewhite') ? ' selected="selected"' : '' ?>
                                            value="threexthreewhite"><?php echo t("3 x 3 White") ?></option>
								</select>
								<div style="clear: both;"></div>
							</span>
                                <label for="video_ratio">
                                    <?php echo t("Aspect Ratio:") ?>
                                </label>
                                <select id="video_ratio" name="video_ratio" style="width:100px">
                                    <option <?php echo ($video_ratio == '16:9') ? ' selected="selected"' : '' ?>
                                    value="16:9"><?php echo t("16:9") ?></option>
                                    <option <?php echo ($video_ratio == '4:3') ? ' selected="selected"' : '' ?>
                                    value="4:3"><?php echo t("4:3") ?></option>
                                </select>
                                <div style="clear: both;"></div>
                                <div>
                                    <label for="video_ratio">
                                        <?php echo t("Start At:") ?>
                                    </label>
                                    <input type="text" value="<?php echo $video_start_at  ?>"
                                           name="video_start_at"> <?php echo t("For Example: 00:17") ?>
                                    <div style="clear: both;"></div>
                                </div>
                                <div>
                                    <label for="video_ratio">
                                        <?php echo t("End At:") ?>
                                    </label>
                                    <input type="text" value="<?php echo $video_end_at  ?>"
                                           name="video_end_at"> <?php echo t("For Example: 02:17") ?>
                                    <div style="clear: both;"></div>
                                </div>
                                <div>
                                    <label for="video_loop"><?php echo t("Loop Video:") ?></label>
                                    <select id="video_loop" name="video_loop" style="width: 200px;">
                                        <option <?php echo  ($video_loop == 'none') ? ' selected="selected"' : '' ?>
                                        value="none"><?php echo t("Disable") ?></option>
                                        <option <?php echo  ($video_loop == 'loop') ? ' selected="selected"' : '' ?>
                                        value="loop"><?php echo t("Loop, Slide is paused") ?></option>
                                        <option <?php echo  ($video_loop == 'loopandnoslidestop') ? ' selected="selected"' : '' ?>
                                        value="loopandnoslidestop"><?php echo t("Loop, Slide does not stop") ?></option>
                                    </select>
                                </div>

                                <div>
                                    <label for="video_nextslide"><?php echo t("Next Slide On End:") ?></label>
                                    <input type="checkbox" class="tp-moderncheckbox" id="video_nextslide"
                                           name="video_nextslide"
                                           data-unchecked="off" <?php echo ($video_nextslide == 'on') ? ' checked="checked"' : '' ?>>
                                </div>
                                <div>
                                    <label for="video_force_rewind"><?php echo t("Rewind at Slide Start:") ?></label>
                                    <input type="checkbox" class="tp-moderncheckbox" id="video_force_rewind"
                                           name="video_force_rewind"
                                           data-unchecked="off" <?php echo ($video_force_rewind == 'on') ? ' checked="checked"' : '' ?>>
                                </div>

                                <div>
                                    <label for="video_mute"><?php echo t("Mute Video:") ?></label>
                                    <input type="checkbox" class="tp-moderncheckbox" id="video_mute" name="video_mute"
                                           data-unchecked="off" <?php echo ($video_mute == 'on') ? ' checked="checked"' : '' ?>>
                                </div>

                                <div class="vid-rev-vimeo-youtube video_volume_wrapper">
                                    <label for="video_volume"><?php echo t("Video Volume:") ?></label>
                                    <input type="text" id="video_volume" name="video_volume"
                                           value="<?php echo $video_volume  ?>">
                                </div>

                                <span id="vid-rev-youtube-options">
								<div>
									<label for="video_speed"><?php echo t("Video Speed:") ?></label>
									<select id="video_speed" name="video_speed" style="width:75px">
                                        <option <?php echo  ($video_speed == '0.25') ? ' selected="selected"' : '' ?>
                                                value="0.25"><?php echo t("0.25") ?></option>
                                        <option <?php echo  ($video_speed == '0.50') ? ' selected="selected"' : '' ?>
                                                value="0.50"><?php echo t("0.50") ?></option>
                                        <option <?php echo  ($video_speed == '1') ? ' selected="selected"' : '' ?>
                                                value="1"><?php echo t("1") ?></option>
                                        <option <?php echo  ($video_speed == '1.5') ? ' selected="selected"' : '' ?>
                                                value="1.5"><?php echo t("1.5") ?></option>
                                        <option <?php echo  ($video_speed == '2') ? ' selected="selected"' : '' ?>
                                                value="2"><?php echo t("2") ?></option>
									</select>
								</div>
								<div>
									<label><?php echo t("Arguments YouTube:") ?></label>
									<input type="text" id="video_arguments" name="video_arguments" style="width:350px;"
                                           value="<?php echo $video_arguments  ?>">
								</div>
							</span>
                                <div id="vid-rev-vimeo-options">
                                    <label><?php echo t("Arguments Vimeo:") ?></label>
                                    <input type="text" id="video_arguments_vim" name="video_arguments_vim"
                                           style="width:350px;"
                                           value="<?php echo $video_arguments_vim  ?>">
                                </div>
                            </div>

                            <div id="bg-setting-wrap">
                                <div id="bg-setting-bgfit-wrap">
                                    <label for="slide_bg_fit"><?php echo t("Background Fit:") ?></label>
                                    <select name="bg_fit" id="slide_bg_fit" style="margin-right:20px">
                                        <option value="cover" <?php echo  ($bgFit == 'cover') ? ' selected="selected"' : '' ?>>
                                        cover
                                        </option>
                                        <option value="contain" <?php echo  ($bgFit == 'contain') ? ' selected="selected"' : '' ?>>
                                        contain
                                        </option>
                                        <option value="percentage" <?php echo  ($bgFit == 'percentage') ? ' selected="selected"' : '' ?>>
                                        (%, %)
                                        </option>
                                        <option value="normal" <?php echo  ($bgFit == 'normal') ? ' selected="selected"' : '' ?>>
                                        normal
                                        </option>
                                    </select>
                                    <input type="text" name="bg_fit_x"
                                           style="min-width:54px;<?php echo !($bgFit == 'percentage') ? 'display: none;' : '' ?> width:60px;margin-right:10px"
                                           value="<?php echo $bgFitX  ?>"/>
                                    <input type="text" name="bg_fit_y"
                                           style="min-width:54px;<?php echo !($bgFit == 'percentage') ? 'display: none;' : '' ?> width:60px;margin-right:10px"
                                           value="<?php echo $bgFitY  ?>"/>
                                </div>
                                <div id="bg-setting-bgpos-def-wrap">
                                    <div id="bg-setting-bgpos-wrap">
                                        <label for="slide_bg_position"
                                               id="bg-position-lbl"><?php echo t("Background Position:") ?></label>
                                        <span id="bg-start-position-wrapper">
										<select name="bg_position" id="slide_bg_position">
                                            <option value="center top"<?php echo  ($bgPosition == 'center top') ? ' selected="selected"' : '' ?>>
                                                center top</option>
                                            <option value="center right"<?php echo  ($bgPosition == 'center right') ? ' selected="selected"' : '' ?>>
                                                center right</option>
                                            <option value="center bottom"<?php echo  ($bgPosition == 'center bottom') ? ' selected="selected"' : '' ?>>
                                                center bottom</option>
                                            <option value="center center"<?php echo  ($bgPosition == 'center center') ? ' selected="selected"' : '' ?>>
                                                center center</option>
                                            <option value="left top"<?php echo  ($bgPosition == 'left top') ? ' selected="selected"' : '' ?>>
                                                left top</option>
                                            <option value="left center"<?php echo  ($bgPosition == 'left center') ? ' selected="selected"' : '' ?>>
                                                left center</option>
                                            <option value="left bottom"<?php echo  ($bgPosition == 'left bottom') ? ' selected="selected"' : '' ?>>
                                                left bottom</option>
                                            <option value="right top"<?php echo  ($bgPosition == 'right top') ? ' selected="selected"' : '' ?>>
                                                right top</option>
                                            <option value="right center"<?php echo  ($bgPosition == 'right center') ? ' selected="selected"' : '' ?>>
                                                right center</option>
                                            <option value="right bottom"<?php echo  ($bgPosition == 'right bottom') ? ' selected="selected"' : '' ?>>
                                                right bottom</option>
                                            <option value="percentage"<?php echo  ($bgPosition == 'percentage') ? ' selected="selected"' : '' ?>>
                                                (x%, y%)</option>
										</select>
										<input type="text" name="bg_position_x"
                                               style="min-width:54px;<?php echo !($bgPosition == 'percentage') ? 'display: none;' : '' ?>width:60px;margin-right:10px"
                                               value="<?php echo $bgPositionX  ?>"/>
										<input type="text" name="bg_position_y"
                                               style="min-width:54px;<?php echo !($bgPosition == 'percentage') ? 'display: none;' : '' ?>width:60px;margin-right:10px"
                                               value="<?php echo $bgPositionY  ?>"/>
									</span>
                                    </div>
                                </div>
                                <div id="bg-setting-bgrep-wrap">
                                    <label><?php echo t("Background Repeat:") ?></label>
                                    <span>
                                <select name="bg_repeat" id="slide_bg_repeat" style="margin-right:20px">
                                    <option value="no-repeat"<?php echo ($bgRepeat == 'no-repeat') ? ' selected="selected"' : '' ?>>
                                no-repeat</option>
                                    <option value="repeat"<?php echo ($bgRepeat == 'repeat') ? ' selected="selected"' : '' ?>>
                                repeat</option>
                                    <option value="repeat-x"<?php echo ($bgRepeat == 'repeat-x') ? ' selected="selected"' : '' ?>>
                                repeat-x</option>
                                    <option value="repeat-y"<?php echo ($bgRepeat == 'repeat-y') ? ' selected="selected"' : '' ?>>
                                repeat-y</option>
                                </select>
                                </span>
                                </div>
                            </div>

                        </div>

                        <span id="mainbg-sub-parallax" style="display:none">
                                <p>
                                <?php if($use_parallax === 'off') {?>
                                    <i style="color:#c0392b">
                                <?php echo t("Parallax Feature in Slider Settings is deactivated, parallax will be ignored.")  ?>
                            </i>
                                <?php } else { ?>
                                    <?php if($parallaxisddd == 'off') { ?>
                                        <label><?php echo t("Parallax Level:") ?></label>
                                        <select name="slide_parallax_level" id="slide_parallax_level">
                                            <option value="-" <?php echo  ($slide_parallax_level == '-') ? ' selected="selected"' : '' ?>>
                                        <?php echo t("No Parallax") ?></option>
                                            <option value="1" <?php echo  ($slide_parallax_level == '1') ? ' selected="selected"' : '' ?>>
                                        1 - (<?php echo $parallax_level[0]  ?> %)
                                            </option>
                                            <option value="2" <?php echo  ($slide_parallax_level == '2') ? ' selected="selected"' : '' ?>>
                                        2 - (<?php echo $parallax_level[1]  ?> %)
                                            </option>
                                            <option value="3" <?php echo  ($slide_parallax_level == '3') ? ' selected="selected"' : '' ?>>
                                        3 - (<?php echo $parallax_level[2]  ?> %)
                                            </option>
                                            <option value="4" <?php echo  ($slide_parallax_level == '4') ? ' selected="selected"' : '' ?>>
                                        4 - (<?php echo $parallax_level[3]  ?> %)
                                            </option>
                                            <option value="5" <?php echo  ($slide_parallax_level == '5') ? ' selected="selected"' : '' ?>>
                                        5 - (<?php echo $parallax_level[4]  ?> %)
                                            </option>
                                            <option value="6" <?php echo  ($slide_parallax_level == '6') ? ' selected="selected"' : '' ?>>
                                        6 - (<?php echo $parallax_level[5]  ?> %)
                                            </option>
                                            <option value="7" <?php echo  ($slide_parallax_level == '7') ? ' selected="selected"' : '' ?>>
                                        7 - (<?php echo $parallax_level[6]  ?> %)
                                            </option>
                                            <option value="8" <?php echo  ($slide_parallax_level == '8') ? ' selected="selected"' : '' ?>>
                                        8 - (<?php echo $parallax_level[7]  ?> %)
                                            </option>
                                            <option value="9" <?php echo  ($slide_parallax_level == '9') ? ' selected="selected"' : '' ?>>
                                        9 - (<?php echo $parallax_level[8]  ?> %)
                                            </option>
                                            <option value="10" <?php echo  ($slide_parallax_level == '10') ? ' selected="selected"' : '' ?>>
                                        10 - (<?php echo $parallax_level[9]  ?> %)
                                            </option>
                                            <option value="11" <?php echo  ($slide_parallax_level == '11') ? ' selected="selected"' : '' ?>>
                                        11 - (<?php echo $parallax_level[10]  ?>> %)
                                            </option>
                                            <option value="12" <?php echo  ($slide_parallax_level == '12') ? ' selected="selected"' : '' ?>>
                                        12 - (<?php echo $parallax_level[11]  ?>> %)
                                            </option>
                                            <option value="13" <?php echo  ($slide_parallax_level == '13') ? ' selected="selected"' : '' ?>>
                                        13 - (<?php echo $parallax_level[12]  ?>> %)
                                            </option>
                                            <option value="14" <?php echo  ($slide_parallax_level == '14') ? ' selected="selected"' : '' ?>>
                                        14 - (<?php echo $parallax_level[13]  ?>> %)
                                            </option>
                                            <option value="15" <?php echo  ($slide_parallax_level == '15') ? ' selected="selected"' : '' ?>>
                                        15 - (<?php echo $parallax_level[14]  ?>> %)
                                            </option>
                                </select>
                                <?php } else { ?>
                                        <?php if($parallaxbgfreeze == 'off') { ?>
                                            <label><?php echo t("Selected 3D Depth:") ?></label>
                                            <input style="min-width:54px;width:54px" type="text" disabled
                                                   value="<?php echo $parallax_level[15]  ?>%"/>
                                            <span><i><?php echo t("3D Parallax is Enabled via Slider Settings !") ?></i></span>
                                            <?php } else { ?>
                                            <label><?php echo t("Background 3D is Disabled") ?></label>
                                            <span style="display: inline-block;vertical-align: middle;line-height:32px"><i>
                                                <?php echo t("To Enable 3D Parallax for Background please change the Option \"BG 3D Disabled\" to \"OFF\" via the Slider Settings !") ?></i></span>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                                </p>

                                </span>
                        <span id="mainbg-sub-filters" style="display:none">
						<div style="display:none; margin-bottom: 10px;">
							<select id="media-filter-type" name="media-filter-type">
                                <option value="none"><?php echo t("No Filter") ?></option>
									<option <?php echo  ($mediafilter == '_1977') ? ' selected="selected"' : '' ?>
                                            value="_1977">1977</option>
                                <option <?php echo  ($mediafilter == 'aden') ? ' selected="selected"' : '' ?>
                                            value="aden">Aden</option>
                                <option <?php echo  ($mediafilter == 'brooklyn') ? ' selected="selected"' : '' ?>
                                            value="brooklyn">Brooklyn</option>
                                <option <?php echo  ($mediafilter == 'clarendon') ? ' selected="selected"' : '' ?>
                                            value="clarendon">Clarendon</option>
                                <option <?php echo  ($mediafilter == 'earlybird') ? ' selected="selected"' : '' ?>
                                            value="earlybird">Earlybird</option>
                                <option <?php echo  ($mediafilter == 'gingham') ? ' selected="selected"' : '' ?>
                                            value="gingham">Gingham</option>
                                <option <?php echo  ($mediafilter == 'hudson') ? ' selected="selected"' : '' ?>
                                            value="hudson">Hudson</option>
                                <option <?php echo  ($mediafilter == 'inkwell') ? ' selected="selected"' : '' ?>
                                            value="inkwell">Inkwell</option>
                                <option <?php echo  ($mediafilter == 'lark') ? ' selected="selected"' : '' ?>
                                            value="lark">Lark</option>
                                <option <?php echo  ($mediafilter == 'lofi') ? ' selected="selected"' : '' ?>
                                            value="lofi">Lo-Fi</option>
                                <option <?php echo  ($mediafilter == 'mayfair') ? ' selected="selected"' : '' ?>
                                            value="mayfair">Mayfair</option>
                                <option <?php echo  ($mediafilter == 'moon') ? ' selected="selected"' : '' ?>
                                            value="moon">Moon</option>
                                <option <?php echo  ($mediafilter == 'nashville') ? ' selected="selected"' : '' ?>
                                            value="nashville">Nashville</option>
                                <option <?php echo  ($mediafilter == 'perpetua') ? ' selected="selected"' : '' ?>
                                            value="perpetua">Perpetua</option>
                                <option <?php echo  ($mediafilter == 'reyes') ? ' selected="selected"' : '' ?>
                                            value="reyes">Reyes</option>
                                <option <?php echo  ($mediafilter == 'rise') ? ' selected="selected"' : '' ?>
                                            value="rise">Rise</option>
                                <option <?php echo  ($mediafilter == 'slumber') ? ' selected="selected"' : '' ?>
                                            value="slumber">Slumber</option>
                                <option <?php echo  ($mediafilter == 'toaster') ? ' selected="selected"' : '' ?>
                                            value="toaster">Toaster</option>
                                <option <?php echo  ($mediafilter == 'walden') ? ' selected="selected"' : '' ?>
                                            value="walden">Walden</option>
                                <option<?php echo  ($mediafilter == 'willow') ? ' selected="selected"' : '' ?>
                                            value="willow">Willow</option>
                                <option <?php echo  ($mediafilter == 'xpro2') ? ' selected="selected"' : '' ?>
                                            value="xpro2">X-pro II</option>
							</select>
						</div>
						<div id="inst-filter-grid">
							<div data-type="none" class="filter_none inst-filter-griditem selected"><div
                                        class="ifgname"><?php echo t("No Filter") ?></div><div
                                        class="inst-filter-griditem-img none"
                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="_1977" class="filter__1977 inst-filter-griditem "><div
                                        class="ifgname">1977</div><div class="inst-filter-griditem-img _1977"
                                                                       style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="aden" class="filter_aden inst-filter-griditem "><div
                                        class="ifgname">Aden</div><div class="inst-filter-griditem-img aden"
                                                                       style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="brooklyn" class="filter_brooklyn inst-filter-griditem "><div
                                        class="ifgname">Brooklyn</div><div class="inst-filter-griditem-img brooklyn"
                                                                           style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="clarendon" class="filter_clarendon inst-filter-griditem "><div
                                        class="ifgname">Clarendon</div><div class="inst-filter-griditem-img clarendon"
                                                                            style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="earlybird" class="filter_earlybird inst-filter-griditem "><div
                                        class="ifgname">Earlybird</div><div class="inst-filter-griditem-img earlybird"
                                                                            style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="gingham" class="filter_gingham inst-filter-griditem "><div class="ifgname">Gingham</div><div
                                        class="inst-filter-griditem-img gingham"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="hudson" class="filter_hudson inst-filter-griditem "><div class="ifgname">Hudson</div><div
                                        class="inst-filter-griditem-img hudson"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="inkwell" class="filter_inkwell inst-filter-griditem "><div class="ifgname">Inkwell</div><div
                                        class="inst-filter-griditem-img inkwell"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="lark" class="filter_lark inst-filter-griditem "><div
                                        class="ifgname">Lark</div><div class="inst-filter-griditem-img lark"
                                                                       style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="lofi" class="filter_lofi inst-filter-griditem "><div
                                        class="ifgname">Lo-Fi</div><div class="inst-filter-griditem-img lofi"
                                                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="mayfair" class="filter_mayfair inst-filter-griditem "><div class="ifgname">Mayfair</div><div
                                        class="inst-filter-griditem-img mayfair"
                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="moon" class="filter_moon inst-filter-griditem "><div
                                        class="ifgname">Moon</div><div class="inst-filter-griditem-img moon"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="nashville" class="filter_nashville inst-filter-griditem "><div
                                        class="ifgname">Nashville</div><div
                                        class="inst-filter-griditem-img nashville"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="perpetua" class="filter_perpetua inst-filter-griditem "><div
                                        class="ifgname">Perpetua</div><div class="inst-filter-griditem-img perpetua"
                                                                           style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="reyes" class="filter_reyes inst-filter-griditem "><div
                                        class="ifgname">Reyes</div><div class="inst-filter-griditem-img reyes"
                                                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="rise" class="filter_rise inst-filter-griditem "><div
                                        class="ifgname">Rise</div><div class="inst-filter-griditem-img rise"
                                                                       style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="slumber" class="filter_slumber inst-filter-griditem "><div class="ifgname">Slumber</div><div
                                        class="inst-filter-griditem-img slumber"
                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="toaster" class="filter_toaster inst-filter-griditem "><div class="ifgname">Toaster</div><div
                                        class="inst-filter-griditem-img toaster"
                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="walden" class="filter_walden inst-filter-griditem "><div class="ifgname">Walden</div><div
                                        class="inst-filter-griditem-img walden"
                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="willow" class="filter_willow inst-filter-griditem "><div class="ifgname">Willow</div><div
                                        class="inst-filter-griditem-img willow"
                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
							<div data-type="xpro2" class="filter_xpro2 inst-filter-griditem "><div class="ifgname">X-pro II</div><div
                                        class="inst-filter-griditem-img xpro2"
                                        style="visibility: inherit; opacity: 1;"></div><div
                                        class="inst-filter-griditem-img-noeff"></div></div>
						</div>
					</span>
                        <div id="mainbg-sub-kenburns" style="display:none; position:relative">
                            <div>
                                <label><?php echo t("Ken Burns / Pan Zoom:") ?></label>
                                <input type="checkbox" class="tp-moderncheckbox withlabel" id="kenburn_effect"
                                       name="kenburn_effect" data-unchecked="off"
                                       <?php echo ($kenburn_effect == 'on') ? ' checked="checked"' : '' ?>>
                            </div>
                            <div id="kenburn_wrapper" <?php echo ($kenburn_effect == 'off') ? 'style="display: none;"' : '' ?>>
                            <div id="ken_burn_example_wrapper">
                                <div id="kenburn-playpause-wrapper"><i
                                            class="eg-icon-play"></i><span><?php echo t("PLAY") ?></span>
                                </div>
                                <div id="kenburn-backtoidle"></div>
                                <div id="ken_burn_example">
                                    <div id="ken_burn_slot_example" class="tp-bgimg defaultimg">
                                    </div>
                                </div>
                            </div>

                            <p>
                                <label><?php echo t("Scale: (in %):") ?></label>
                                <label style="min-width:40px"><?php echo t("From") ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_start_fit" id="kb_start_fit"
                                       value="<?php echo $kb_start_fit  ?>"/>
                                <label style="min-width:20px"><?php echo t("To")  ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_end_fit" id="kb_end_fit"
                                       value="<?php echo $kb_end_fit  ?>"/>
                            </p>

                            <p>
                                <label><?php echo t("Horizontal Offsets (+/-):")  ?></label>
                                <label style="min-width:40px"><?php echo t("From") ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_start_offset_x" id="kb_start_offset_x"
                                       value="<?php echo $kbStartOffsetX  ?>"/>
                                <label style="min-width:20px"><?php echo t("To")  ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_end_offset_x" id="kb_end_offset_x"
                                       value="<?php echo $kbEndOffsetX  ?>"/>
                            </p>

                            <p>
                                <label><?php echo t("Vertical Offsets (+/-):")  ?></label>
                                <label style="min-width:40px"><?php echo t("From") ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_start_offset_y" id="kb_start_offset_y"
                                       value="<?php echo $kbStartOffsetY  ?>"/>
                                <label style="min-width:20px"><?php echo t("To")  ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_end_offset_y" id="kb_end_offset_y"
                                       value="<?php echo $kbEndOffsetY  ?>"/>
                            </p>
                            <p>
                                <label><?php echo t("Rotation:")  ?></label>
                                <label style="min-width:40px"><?php echo t("From") ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_start_rotate" id="kb_start_rotate"
                                       value="<?php echo $kbStartRotate  ?>"/>
                                <label style="min-width:20px"><?php echo t("To")  ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_end_rotate" id="kb_end_rotate"
                                       value="<?php echo $kbEndRotate  ?>"/>
                            </p>

                            <p>
                                <label><?php echo t("Blur Filter:")  ?></label>
                                <label style="min-width:40px"><?php echo t("From") ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_blur_start" id="kb_blur_start"
                                       value="<?php echo $kbBlurStart  ?>"/>
                                <label style="min-width:20px"><?php echo t("To")  ?></label>
                                <input style="min-width:54px;width:54px" class="kb_input_values" type="text"
                                       name="kb_blur_end" id="kb_blur_end"
                                       value="<?php echo $kbBlurEnd  ?>"/>
                            </p>

                            <p>
                                <label><?php echo t("Easing:") ?></label>
                                <select name="kb_easing" id="kb_easing" class="kb_input_values">
                                    <option <?php echo  ($kb_easing == 'Linear.easeNone') ? ' selected="selected"' : '' ?>
                                    value="Linear.easeNone">
                                    Linear.easeNone
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power0.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Power0.easeIn">
                                    Power0.easeIn (linear)
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power0.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Power0.easeInOut">
                                    Power0.easeInOut (linear)
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power0.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Power0.easeOut">
                                    Power0.easeOut (linear)
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power1.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Power1.easeIn">
                                    Power1.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power1.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Power1.easeInOut">
                                    Power1.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power1.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Power1.easeOut">
                                    Power1.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power2.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Power2.easeIn">
                                    Power2.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power2.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Power2.easeInOut">
                                    Power2.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power2.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Power2.easeOut">
                                    Power2.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power3.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Power3.easeIn">
                                    Power3.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power3.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Power3.easeInOut">
                                    Power3.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power3.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Power3.easeOut">
                                    Power3.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power4.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Power4.easeIn">
                                    Power4.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power4.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Power4.easeInOut">
                                    Power4.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Power4.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Power4.easeOut">
                                    Power4.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Back.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Back.easeIn">
                                    Back.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Back.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Back.easeInOut">
                                    Back.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Back.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Back.easeOut">
                                    Back.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Bounce.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Bounce.easeIn">
                                    Bounce.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Bounce.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Bounce.easeInOut">
                                    Bounce.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Bounce.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Bounce.easeOut">
                                    Bounce.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Circ.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Circ.easeIn">
                                    Circ.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Circ.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Circ.easeInOut">
                                    Circ.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Circ.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Circ.easeOut">
                                    Circ.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Elastic.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Elastic.easeIn">
                                    Elastic.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Elastic.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Elastic.easeInOut">Elastic.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Elastic.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Elastic.easeOut">
                                    Elastic.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Expo.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Expo.easeIn">
                                    Expo.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Expo.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Expo.easeInOut">
                                    Expo.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Expo.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Expo.easeOut">
                                    Expo.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Sine.easeIn') ? ' selected="selected"' : '' ?>
                                    value="Sine.easeIn">
                                    Sine.easeIn
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Sine.easeInOut') ? ' selected="selected"' : '' ?>
                                    value="Sine.easeInOut">
                                    Sine.easeInOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'Sine.easeOut') ? ' selected="selected"' : '' ?>
                                    value="Sine.easeOut">
                                    Sine.easeOut
                                    </option>
                                    <option <?php echo  ($kb_easing == 'SlowMo.ease') ? ' selected="selected"' : '' ?>
                                    value="SlowMo.ease">
                                    SlowMo.ease
                                    </option>
                                </select>
                            </p>
                            <p>
                                <label><?php echo t("Duration (in ms):")  ?></label>
                                <input type="text" name="kb_duration" class="kb_input_values"
                                       id="kb_duration"
                                       value="<?php echo $kb_duration  ?>"/>
                            </p>
                        </div>
                    </div>

                    <input type="hidden" id="image_url" name="image_url"
                           value="<?php echo $imageUrl  ?>"/>
                    <input type="hidden" id="image_id" name="image_id"
                           value="<?php echo $imageID  ?>"/>
            </div>
                    <?php endif; ?>
            <div id="slide-general-settings-content"
                 style="<?php echo !$slide['isStaticSlide'] ? ' display:none' : '' ?>">
                <?php if(!($slide['isStaticSlide'])) {?>
                <!-- SLIDE TITLE -->
                <p style="display:none">
                    <label><?php echo t("Slide Title") ?></label>
                    <input type="text" class="medium" id="title" disabled="disabled" name="title"
                           value="<?php echo $title  ?>">
                    <span class="description"><?php echo t("The title of the slide, will be shown in the slides list.") ?></span>
                </p>

                <!-- SLIDE DELAY -->
                <p>
                    <label><?php echo t("Slide \"Delay\":") ?></label>
                    <input type="text" class="small-text" id="delay" name="delay"
                           value="<?php echo $delay  ?>">
                    <span class="description"><?php echo t("A new delay value for the Slide. If no delay defined per slide, the delay defined via Options (9000ms) will be used.") ?></span>
                </p>

                <!-- SLIDE PAUSE ON PURPOSE -->
                <p>
                    <label><?php echo t("Pause Slider:") ?></label>
                    <select id="stoponpurpose" name="stoponpurpose">
                        <option value="false"<?php echo ($stoponpurpose == 'false' )? ' selected="selected"' : '' ?>>
                        <?php echo t("Default") ?></option>
                        <option value="true"<?php echo ($stoponpurpose == 'true' )? ' selected="selected"' : '' ?>>
                        <?php echo t("Stop Slider Progress") ?></option>
                    </select>
                    <span class="description"><?php echo t("Stop Slider Progress on this slider or use Slider Settings Defaults") ?></span>
                </p>


                <!-- SLIDE PAUSE ON PURPOSE -->
                <p>
                    <label><?php echo t("Slide in Navigation (invisible):") ?></label>
                    <select id="invisibleslide" name="invisibleslide">
                        <option value="false"<?php echo ($invisibleslide == 'false' )? ' selected="selected"' : '' ?>>
                        <?php echo t("Show Always") ?></option>
                        <option value="true"<?php echo ($invisibleslide == 'true' )? ' selected="selected"' : '' ?>>
                        <?php echo t("Only Via Actions") ?></option>
                    </select>
                    <span class="description"><?php echo t("Show Slide always or only on Action calls. Invisible slides are not available due Navigation Elements.") ?></span>
                </p>


                <!-- SLIDE STATE -->
                <p>
                    <label><?php echo t("Slide State:") ?></label>
                    <select id="state" name="state">
                        <option value="published"<?php echo ($state == 'published' )? ' selected="selected"' : '' ?>>
                        <?php echo t("Published") ?></option>
                        <option value="unpublished"<?php echo ($state == 'unpublished' )? ' selected="selected"' : '' ?>>
                        <?php echo t("Unpublished") ?></option>
                    </select>
                    <span class="description"><?php echo t("The state of the slide. The unpublished slide will be excluded from the slider.") ?></span>
                </p>

                <!-- SLIDE HIDE AFTER LOOP -->
                <p>
                    <label><?php echo t("Hide Slide After Loop:") ?></label>
                    <input type="text" class="small-text" id="hideslideafter" name="hideslideafter"
                           value="<?php echo $hideslideafter  ?>">
                    <span class="description"><?php echo t("After how many Loops should the Slide be hidden ? 0 = Slide is never hidden.") ?></span>
                </p>

                <!-- HIDE SLIDE ON MOBILE -->
                <p>
                    <label><?php echo t("Hide Slide On Mobile:") ?></label>
                    <span style="display:inline-block; width:200px; margin-right:20px;line-height:27px">
								<input type="checkbox" class="tp-moderncheckbox" id="hideslideonmobile"
                                       name="hideslideonmobile"
                                       data-unchecked="off" <?php echo ($hideslideonmobile == 'on') ? ' checked="checked"' : '' ?>>
							</span>
                    <span class="description"><?php echo t("Show/Hide this Slide if Slider loaded on Mobile Device.") ?></span>
                </p>

                <!-- SLIDE VISIBLE FROM -->
                <p>
                    <label><?php echo t("Visible from:") ?></label>
                    <input type="text" class="inputDatePicker" id="date_from" name="date_from"
                           value="<?php echo $date_from  ?>">
                    <span class="description"><?php echo t("If set, slide will be visible after the date is reached.") ?></span>
                </p>

                <!-- SLIDE VISIBLE UNTIL -->
                <p>
                    <label><?php echo t("Visible until:") ?></label>
                    <input type="text" class="inputDatePicker" id="date_to" name="date_to"
                           value="<?php echo $date_to  ?>">
                    <span class="description"><?php echo t("If set, slide will be visible till the date is reached.") ?></span>
                </p>


                <!-- SLIDE VISIBLE FROM -->
                <p style="display:none">
                    <label><?php echo t("Save Performance:") ?></label>
                    <span style="display:inline-block; width:200px; margin-right:20px;">
								<input type="checkbox" class="tp-moderncheckbox withlabel" id="save_performance"
                                       name="save_performance"
                                       data-unchecked="off" <?php echo ($save_performance == 'on') ? ' checked="checked"' : '' ?>>
							</span>
                    <span class="description"><?php echo t("Slide End Transition will first start when last Layer has been removed.") ?></span>
                </p>
                <?php } else { ?>
                <!-- STATIC LAYER OVERFLOW (ON/OFF) -->
                <p>
                    <label><?php echo t("Static Layers Overflow:") ?></label>
                    <select id="staticoverflow" name="staticoverflow">
                        <option value="visible"<?php echo ($staticoverflow == 'visible' ) ? ' selected="selected' : '' ?>><?php echo t("Visible") ?></option>
                        <option value="hidden"<?php echo ($staticoverflow == 'hidden' ) ? ' selected="selected' : '' ?>><?php echo t("Hidden") ?></option>
                    </select>
                    <span class="description"><?php echo t("Set the Overflow of Static Layers to Visible or Hidden.") ?></span>
                </p>
                <?php } ?>
            </div>
                    <?php if(!$slide['isStaticSlide']) { ?>
            <!-- THUMBNAIL SETTINGS -->
            <div id="slide-thumbnail-settings-content" style="display:none">
                <!-- THUMBNAIL SETTINGS -->
                <div style="margin-top:10px">
                    <span style="display:inline-block; vertical-align: top;">
							<label><?php echo t("Thumbnail:") ?></label>
						</span>
                    <div style="display:inline-block; vertical-align: top;">
                        <div id="slide_thumb_button_preview" class="setting-image-preview">
                            <?php if(!empty($slide_thumb_url)) : ?>
                            <div style="width:100px;height:70px;
                                    background:url('<?php echo $slide_thumb_url  ?>');
                                    background-position:center center; background-size:cover;"></div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" id="slide_thumb" name="slide_thumb"
                               value="<?php echo $slide_thumb  ?>">
                        <span style="clear:both;display:block"></span>
                        <input type="button" id="slide_thumb_button"
                               style="width:110px !important; display:inline-block;"
                               class="button-image-select button-primary revblue" value="Choose Image"
                               original-title="">
                        <input type="button" id="slide_thumb_button_remove"
                               style="margin-right:20px !important; width:85px !important; display:inline-block;"
                               class="button-image-remove button-primary revred" value="Remove"
                               original-title="">
                        <span class="description"><?php echo t("Slide Thumbnail. If not set - it will be taken from the slide image.") ?></span>
                    </div>
                </div>
                <p>
						<span style="display:inline-block; vertical-align: top;">
							<label><?php echo t("Thumbnail Dimensions:") ?></label>
						</span>
                    <select name="thumb_dimension">
                        <option value="slider" <?php echo  ($thumb_dimension == 'slider')? ' selected="selected"' : '' ?>>
                        <?php echo t("From Slider Settings") ?></option>
                        <option value="orig" <?php echo  ($thumb_dimension == 'orig')? ' selected="selected"' : '' ?>>
                        <?php echo t("Original Size") ?></option>
                    </select>
                    <span class="description"><?php echo t("Width and height of thumbnails can be changed in the Slider Settings -> Navigation -> Thumbs tab.") ?></span>
                </p>

                <p style="display:none;" class="show_on_thumbnail_exist">
						<span style="display:inline-block; vertical-align: top;">
							<label><?php echo t("Thumbnail Admin Purpose:") ?></label>
						</span>
                    <span style="display:inline-block; width:200px; margin-right:20px;line-height:27px">
							<input type="checkbox" class="tp-moderncheckbox" id="thumb_for_admin" name="thumb_for_admin"
                                   data-unchecked="off" <?php echo($thumb_for_admin == 'on')? ' checked="checked"' : '' ?>>
						</span>
                    <span class="description"><?php echo t("Use the Thumbnail also for Admin purposes. This will use the selected Thumbnail to represent the Slide in all Slider Admin area.") ?></span>
                </p>
            </div>

            <!-- SLIDE ANIMATIONS -->
            <div id="slide-animation-settings-content" style="display:none">

                <!-- ANIMATION / TRANSITION -->
                <div id="slide_transition_row">
                    <script type="text/javascript">
                        var choosen_slide_transition = [<?php echo $js_choosen_slide_transition ?>];
                        var transition_settings = {
                            'slot': [<?php echo $js_transition_settings['slot']?>],
                        'rotation': [<?php echo $js_transition_settings['rotation'] ?>],
                        'duration': [<?php echo $js_transition_settings['duration'] ?>],
                        'ease_in': [<?php echo $js_transition_settings['ease_in'] ?>],
                        'ease_out': [<?php echo $js_transition_settings['ease_out'] ?>]
                        };
                    </script>
                    <div id="slide_transition" multiple="" size="1" style="z-index: 100;">
                        <?php echo $transmenu ?>
                        <?php echo $listoftrans ?>
                        <div class="slide-trans-example">
                            <div class="slide-trans-example-inner">
                                <div class="oldslotholder"
                                     style="overflow:hidden;width:100%;height:100%;position:absolute;top:0px;left:0px;z-index:1">
                                    <div class="tp-bgimg defaultimg slide-transition-example"></div>
                                </div>
                                <div class="slotholder"
                                     style="overflow:hidden;width:100%;height:100%;position:absolute;top:0px;left:0px;z-index:1">
                                    <div class="tp-bgimg defaultimg slide-transition-example"></div>
                                </div>
                            </div>
                        </div>
                        <div class="slide-trans-cur-selected">
                            <p><?php echo t("Used Transitions (Order in Loops)") ?></p>
                            <ul class="slide-trans-cur-ul">
                            </ul>
                        </div>
                        <div class="slide-trans-cur-selected-settings">
                            <!-- SLOT AMOUNT -->

                            <label><?php echo t("Slot / Box Amount:") ?></label>
                            <input type="text" class="small-text input-deepselects" id="slot_amount"
                                   name="slot_amount" value="<?php echo $slot_amount[0]  ?>"
                                   data-selects="1||Random||Custom||Default"
                                   data-svalues="1||random||3||default"
                                   data-icons="thumbs-up||shuffle||wrench||key">
                            <span class="tp-clearfix"></span>
                            <span class="description"><?php echo t("# of slots/boxes the slide is divided into or divided by.") ?></span>
                            <span class="tp-clearfix"></span>

                            <!-- ROTATION -->

                            <label><?php echo t("Slot Rotation:") ?></label>
                            <input type="text" class="small-text input-deepselects" id="transition_rotation"
                                   name="transition_rotation"
                                   value="<?php echo $transition_rotation[0]  ?>"
                                   data-selects="0||Random||Custom||Default||45||90||180||270||360"
                                   data-svalues="0||random||-75||default||45||90||180||270||360"
                                   data-icons="thumbs-up||shuffle||wrench||key||star-empty||star-empty||star-empty||star-empty||star-empty">
                            <span class="tp-clearfix"></span>
                            <span class="description"><?php echo t("Start Rotation of Transition (deg).") ?></span>
                            <span class="tp-clearfix"></span>

                            <!-- DURATION -->

                            <label><?php echo t("Animation Duration:") ?></label>
                            <input type="text" class="small-text input-deepselects" id="transition_duration"
                                   name="transition_duration"
                                   value="<?php echo $transition_duration[0]  ?>"
                                   data-selects="300||Random||Custom||Default"
                                   data-svalues="500||random||650||default"
                                   data-icons="thumbs-up||shuffle||wrench||key">
                            <span class="tp-clearfix"></span>
                            <span class="description"><?php echo t("The duration of the transition.") ?></span>
                            <span class="tp-clearfix"></span>

                            <!-- IN EASE -->

                            <label><?php echo t("Easing In:") ?></label>
                            <select name="transition_ease_in">
                                <option value="default">Default</option>
                                <option value="Linear.easeNone">Linear.easeNone</option>
                                <option value="Power0.easeIn">Power0.easeIn (linear)</option>
                                <option value="Power0.easeInOut">Power0.easeInOut (linear)</option>
                                <option value="Power0.easeOut">Power0.easeOut (linear)</option>
                                <option value="Power1.easeIn">Power1.easeIn</option>
                                <option value="Power1.easeInOut">Power1.easeInOut</option>
                                <option value="Power1.easeOut">Power1.easeOut</option>
                                <option value="Power2.easeIn">Power2.easeIn</option>
                                <option value="Power2.easeInOut">Power2.easeInOut</option>
                                <option value="Power2.easeOut">Power2.easeOut</option>
                                <option value="Power3.easeIn">Power3.easeIn</option>
                                <option value="Power3.easeInOut">Power3.easeInOut</option>
                                <option value="Power3.easeOut">Power3.easeOut</option>
                                <option value="Power4.easeIn">Power4.easeIn</option>
                                <option value="Power4.easeInOut">Power4.easeInOut</option>
                                <option value="Power4.easeOut">Power4.easeOut</option>
                                <option value="Back.easeIn">Back.easeIn</option>
                                <option value="Back.easeInOut">Back.easeInOut</option>
                                <option value="Back.easeOut">Back.easeOut</option>
                                <option value="Bounce.easeIn">Bounce.easeIn</option>
                                <option value="Bounce.easeInOut">Bounce.easeInOut</option>
                                <option value="Bounce.easeOut">Bounce.easeOut</option>
                                <option value="Circ.easeIn">Circ.easeIn</option>
                                <option value="Circ.easeInOut">Circ.easeInOut</option>
                                <option value="Circ.easeOut">Circ.easeOut</option>
                                <option value="Elastic.easeIn">Elastic.easeIn</option>
                                <option value="Elastic.easeInOut">Elastic.easeInOut</option>
                                <option value="Elastic.easeOut">Elastic.easeOut</option>
                                <option value="Expo.easeIn">Expo.easeIn</option>
                                <option value="Expo.easeInOut">Expo.easeInOut</option>
                                <option value="Expo.easeOut">Expo.easeOut</option>
                                <option value="Sine.easeIn">Sine.easeIn</option>
                                <option value="Sine.easeInOut">Sine.easeInOut</option>
                                <option value="Sine.easeOut">Sine.easeOut</option>
                                <option value="SlowMo.ease">SlowMo.ease</option>
                            </select>
                            <span class="tp-clearfix"></span>
                            <span class="description"><?php echo t("The easing of Appearing transition.") ?></span>
                            <span class="tp-clearfix"></span>

                            <!-- OUT EASE -->

                            <label><?php echo t("Easing Out:") ?></label>
                            <select name="transition_ease_out">
                                <option value="default">Default</option>
                                <option value="Linear.easeNone">Linear.easeNone</option>
                                <option value="Power0.easeIn">Power0.easeIn (linear)</option>
                                <option value="Power0.easeInOut">Power0.easeInOut (linear)</option>
                                <option value="Power0.easeOut">Power0.easeOut (linear)</option>
                                <option value="Power1.easeIn">Power1.easeIn</option>
                                <option value="Power1.easeInOut">Power1.easeInOut</option>
                                <option value="Power1.easeOut">Power1.easeOut</option>
                                <option value="Power2.easeIn">Power2.easeIn</option>
                                <option value="Power2.easeInOut">Power2.easeInOut</option>
                                <option value="Power2.easeOut">Power2.easeOut</option>
                                <option value="Power3.easeIn">Power3.easeIn</option>
                                <option value="Power3.easeInOut">Power3.easeInOut</option>
                                <option value="Power3.easeOut">Power3.easeOut</option>
                                <option value="Power4.easeIn">Power4.easeIn</option>
                                <option value="Power4.easeInOut">Power4.easeInOut</option>
                                <option value="Power4.easeOut">Power4.easeOut</option>
                                <option value="Back.easeIn">Back.easeIn</option>
                                <option value="Back.easeInOut">Back.easeInOut</option>
                                <option value="Back.easeOut">Back.easeOut</option>
                                <option value="Bounce.easeIn">Bounce.easeIn</option>
                                <option value="Bounce.easeInOut">Bounce.easeInOut</option>
                                <option value="Bounce.easeOut">Bounce.easeOut</option>
                                <option value="Circ.easeIn">Circ.easeIn</option>
                                <option value="Circ.easeInOut">Circ.easeInOut</option>
                                <option value="Circ.easeOut">Circ.easeOut</option>
                                <option value="Elastic.easeIn">Elastic.easeIn</option>
                                <option value="Elastic.easeInOut">Elastic.easeInOut</option>
                                <option value="Elastic.easeOut">Elastic.easeOut</option>
                                <option value="Expo.easeIn">Expo.easeIn</option>
                                <option value="Expo.easeInOut">Expo.easeInOut</option>
                                <option value="Expo.easeOut">Expo.easeOut</option>
                                <option value="Sine.easeIn">Sine.easeIn</option>
                                <option value="Sine.easeInOut">Sine.easeInOut</option>
                                <option value="Sine.easeOut">Sine.easeOut</option>
                                <option value="SlowMo.ease">SlowMo.ease</option>
                            </select>
                            <span class="tp-clearfix"></span>
                            <span class="description"><?php echo t("The easing of Disappearing transition.") ?></span>

                        </div>

                    </div>

                </div>


            </div>

            <!-- SLIDE BASIC INFORMATION -->
            <div id="slide-nav-settings-content" style="display:none">
                <ul class="rs-layer-nav-settings-tabs" style="display:inline-block; ">
                    <li id="custom-nav-arrows-tab-selector" data-content="arrows"
                        class="selected"><?php echo t("Arrows") ?></li>
                    <li id="custom-nav-bullets-tab-selector"
                        data-content="bullets"><?php echo t("Bullets") ?></li>
                    <li id="custom-nav-tabs-tab-selector" data-content="tabs"><?php echo t("Tabs") ?></li>
                    <li id="custom-nav-thumbs-tab-selector"
                        data-content="thumbs"><?php echo t("Thumbnails") ?></li>
                </ul>

                <div class="tp-clearfix"></div>


                <ul id="navigation-placeholder-wrapper">
                    <?php echo $html_navigation_placeholder_wrapper ?>
                </ul>
                <p style="margin-top:25px">
                    <i><?php echo t("The Custom Settings are always depending on the current selected Navigation Elements in Slider Settings, and will only be active on the current Slide.") ?></i>
                </p>
                <script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function () {
                        if (jQuery('.custom-nav-types.nav-type-arrows').length == 0)
                            jQuery('#custom-nav-arrows-tab-selector').remove();

                        if (jQuery('.custom-nav-types.nav-type-bullets').length == 0)
                            jQuery('#custom-nav-bullets-tab-selector').remove();

                        if (jQuery('.custom-nav-types.nav-type-tabs').length == 0)
                            jQuery('#custom-nav-tabs-tab-selector').remove();

                        if (jQuery('.custom-nav-types.nav-type-thumbs').length == 0)
                            jQuery('#custom-nav-thumbs-tab-selector').remove();

                        if (jQuery('#navigation-placeholder-wrapper li').length == 0)
                            jQuery('#main-menu-nav-settings-li').remove();


                        jQuery('.rs-layer-nav-settings-tabs li').click(function () {
                            var tn = jQuery(this);
                            jQuery('.custom-nav-types').hide();
                            jQuery('.custom-nav-types.nav-type-' + tn.data('content')).show();
                            jQuery('.rs-layer-nav-settings-tabs .selected').removeClass("selected");
                            tn.addClass("selected");
                        });

                        setTimeout(function () {
                            jQuery('.rs-layer-nav-settings-tabs li:nth-child(1)').click();
                        }, 100)

                    });
                </script>
            </div>
                    <?php } ?>
            <!-- SLIDE ADDON WRAP -->
            <div id="slide-addon-wrapper" style="margin:-15px; display:none">
                <div id="rs-addon-wrapper-button-row">
                    <span class="rs-layer-toolbar-box"
                          style="padding:5px 20px"><?php echo t("Select Add-on") ?></span>
                    <?php foreach ($slide_general_addon as $rs_addon_handle => $rs_addon): ?>
                    <span class="rs-layer-toolbar-box">
								<span id="rs-addon-settings-trigger-<?php echo $rs_addon_handle  ?>"
                                      class="rs-addon-settings-trigger"><?php echo $rs_addon['title']  ?></span>
							</span>
                    <?php endforeach; ?>
                </div>
                <div style="border-top:1px solid #ddd;">
                    <?php foreach ($slide_general_addon as $rs_addon_handle => $rs_addon) : ?>
                    <div id="rs-addon-settings-trigger-<?php echo $rs_addon_handle  ?>-settings"
                         class="rs-addon-settings-wrapper-settings" style="display: none;">
                        <?php echo $rs_addon['markup'] ?>
                        <script type="text/javascript">
                            <?php echo $rs_addon['javascript'] ?>
                        </script>
                    </div>
                    <?php endforeach; ?>
                    <script type="text/javascript">
                        document.addEventListener("DOMContentLoaded", function () {
                            jQuery('.rs-addon-settings-trigger').click(function () {
                                var show_addon = jQuery(this).attr('id');
                                jQuery('.rs-addon-settings-trigger').removeClass("selected");
                                jQuery(this).addClass("selected");
                                jQuery('.rs-addon-settings-wrapper-settings').hide();
                                jQuery('#' + show_addon + '-settings').show();
                            });
                        });
                    </script>
                </div>
            </div>
                    <?php if($slide['isStaticSlide']) : ?>
            <!-- SLIDE BASIC INFORMATION -->
            <div id="slide-info-settings-content" style="display:none">
                <ul>
                    <?php foreach ($slide_info_settings as $info_setting) : ?>
                    <li>
                        <label><?php echo t("Parameter") ?> <?php echo $info_setting['index']  ?></label>
                        <input type="text" name="params_<?php echo $info_setting['index']  ?>"
                               value="<?php echo $info_setting['value']  ?>">
                        <?php echo t("Max. Chars") ?>
                        <input type="text" style="width: 50px; min-width: 50px;"
                               name="params_<?php echo $info_setting['index']  ?>_chars"
                               value="<?php echo $info_setting['max_chars']  ?>">
                        <?php if($slider_type !== 'gallery'): ?>
                        <i class="eg-icon-pencil rs-param-meta-open"
                           data-curid="<?php echo $info_setting['index']  ?>"></i>
                            <?php endif; ?>
                    </li>
                            <?php endforeach; ?>
                </ul>

                <!-- BASIC DESCRIPTION -->
                <p>
                    <label><?php echo t("Description of Slider:") ?></label>

                    <textarea name="slide_description"
                              style="height: 425px; width: 100%"><?php echo $slide_description  ?></textarea>
                    <span class="description"><?php echo t("Define a description here to show at the navigation if enabled in Slider Settings") ?></span>
                </p>
            </div>

            <!-- SLIDE SEO INFORMATION -->
            <div id="slide-seo-settings-content" style="display:none">
                <!-- CLASS -->
                <p>
                    <label><?php echo t("Class:") ?></label>
                    <input type="text" class="" id="class_attr" name="class_attr"
                           value="<?php echo $class_attr  ?>">
                    <span class="description"><?php echo t("Adds a unique class to the li of the Slide like class=\"rev_special_class\" (add only the classnames, seperated by space)") ?></span>
                </p>

                <!-- ID -->
                <p>
                    <label><?php echo t("ID:") ?></label>
                    <input type="text" class="" id="id_attr" name="id_attr"
                           value="<?php echo $id_attr  ?>">
                    <span class="description"><?php echo t("Adds a unique ID to the li of the Slide like id=\"rev_special_id\" (add only the id)") ?></span>
                </p>

                <!-- CUSTOM FIELDS -->
                <p>
                    <label><?php echo t("Custom Fields:") ?></label>
                    <textarea id="data_attr"
                              name="data_attr"><?php echo $data_attr  ?></textarea>
                    <span class="description"><?php echo t("Add as many attributes as you wish here. (i.e.: data-layer=\"firstlayer\" data-custom=\"somevalue\").") ?></span>
                </p>

                <!-- Enable Link -->
                <p>
                    <label><?php echo t("Enable Link:") ?></label>
                    <select id="enable_link" name="enable_link">
                        <option value="true"<?php echo ($enable_link == 'true' ) ? ' selected="selected"' : '' ?>><?php echo t("Enable") ?></option>
                        <option value="false"<?php echo ($enable_link == 'false' ) ? ' selected="selected"' : '' ?>><?php echo t("Disable") ?></option>
                    </select>
                    <span class="description"><?php echo t("Link the Full Slide to an URL or Action.") ?></span>
                </p>

                <div class="rs-slide-link-setting-wrapper">
                    <!-- Link Type -->
                    <p>
                        <label><?php echo t("Link Type:") ?></label>
                        <span style="display:inline-block; width:200px; margin-right:20px;">
								<input type="radio" id="link_type_1" value="regular"
                                       name="link_type"<?php echo ($enable_link_2 == 'regular') ? ' checked="checked" ' : '' ?>>
                                <span style="line-height:30px; vertical-align: middle; margin:0px 20px 0px 10px;"><?php echo t("Regular") ?></span>
								<input type="radio" id="link_type_2" value="slide"
                                       name="link_type"<?php echo ($enable_link_2 == 'slide') ? ' checked="checked" ' : '' ?>>
                                <span style="line-height:30px; vertical-align: middle; margin:0px 20px 0px 10px;"><?php echo t("To Slide") ?></span>
							</span>
                        <span class="description"><?php echo t("Regular - Link to URL,  To Slide - Call a Slide Action") ?></span>
                    </p>

                    <div class="rs-regular-link-setting-wrap">
                        <!-- SLIDE LINK -->
                        <p>
                            <label><?php echo t("Slide Link:") ?></label>
                            <input type="text" id="rev_link" name="link"
                                   value="<?php echo $val_link  ?>">
                            <span class="description"><?php echo t("A link on the whole slide pic (use {{link}} or {{meta:somemegatag}} in template sliders to link to a post or some other meta)") ?></span>
                        </p>

                        <!-- LINK TARGET -->
                        <p>
                            <label><?php echo t("Link Target:") ?></label>
                            <select id="link_open_in" name="link_open_in">
                                <option value="same"<?php echo ($link_open_in == 'same' )? ' selected="selected"' : '' ?>>
                                <?php echo t("Same Window") ?></option>
                                <option value="new"<?php echo ($link_open_in == 'new' )? ' selected="selected"' : '' ?>>
                                <?php echo t("New Window") ?></option>
                            </select>
                            <span class="description"><?php echo t("The target of the slide link.") ?></span>
                        </p>
                    </div>
                    <!-- LINK TO SLIDE -->
                    <p class="rs-slide-to-slide">
                        <label><?php echo t("Link To Slide:") ?></label>
                        <select id="slide_link" name="slide_link">
                            <?php foreach ($arrSlideLinkLayers as $link_handle => $link_name ) : ?>
                            <option value="<?php echo $link_handle  ?>" <?php echo ($link_handle == $slide_link ) ? ' selected="selected"' : '' ?>>
                            <?php echo $link_name  ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="description"><?php echo t("Call Slide Action") ?></span>
                    </p>
                    <!-- Link POSITION -->
                    <p>
                        <label><?php echo t("Link Sensibility:") ?></label>
                        <span style="display:inline-block; width:200px; margin-right:20px;">
								<input type="radio" id="link_pos_1" value="front"
                                       name="link_pos"<?php echo ($link_pos == 'front') ? ' checked="checked"' : '' ?>>
                                <span style="line-height:30px; vertical-align: middle; margin:0px 20px 0px 10px;"><?php echo t("Front") ?></span>
								<input type="radio" id="link_pos_2" value="back"
                                       name="link_pos"<?php echo ($link_pos == 'back') ? ' checked="checked"' : '' ?>>
                                <span style="line-height:30px; vertical-align: middle; margin:0px 20px 0px 10px;"><?php echo t("Back") ?></span>
							</span>
                        <span class="description"><?php echo t("The z-index position of the link related to layers") ?></span>
                    </p>
                </div>
            </div>
                    <?php endif; ?>
            </form>
        </div>
        </div>
        <script type="text/javascript">

            document.addEventListener("DOMContentLoaded", function () {

                jQuery('.my-alphacolor-field').tpColorPicker({
                    mode: 'single',
                    wrapper: '<span class="rev-colorpickerspan"></span>'
                });


                jQuery('#enable_link').change(function () {
                    if (jQuery(this).val() == 'true') {
                        jQuery('.rs-slide-link-setting-wrapper').show();
                    } else {
                        jQuery('.rs-slide-link-setting-wrapper').hide();
                    }
                });
                jQuery('#enable_link option:selected').change();

                jQuery('input[name="link_type"]').change(function () {
                    if (jQuery(this).val() == 'regular') {
                        jQuery('.rs-regular-link-setting-wrap').show();
                        jQuery('.rs-slide-to-slide').hide();
                    } else {
                        jQuery('.rs-regular-link-setting-wrap').hide();
                        jQuery('.rs-slide-to-slide').show();
                    }
                });
                jQuery('input[name="link_type"]:checked').change();

            });
        </script>
        <?php
        return ob_get_clean();
    }
}