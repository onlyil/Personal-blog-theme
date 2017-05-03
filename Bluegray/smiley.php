<script type="text/javascript">
    function grin(tag) {
      var myField;
      tag = ' ' + tag + ' ';
        if (document.getElementById('message comment') && document.getElementById('message comment').type == 'textarea') {
        myField = document.getElementById('message comment');
      } else {
        return false;
      }
      if (document.selection) {
        myField.focus();
        sel = document.selection.createRange();
        sel.text = tag;
        myField.focus();
      }
      else if (myField.selectionStart || myField.selectionStart == '0') {
        var startPos = myField.selectionStart;
        var endPos = myField.selectionEnd;
        var cursorPos = startPos;
        myField.value = myField.value.substring(0, startPos)
                + tag
                + myField.value.substring(endPos, myField.value.length);
        cursorPos += tag.length;
        myField.focus();
        myField.selectionStart = cursorPos;
        myField.selectionEnd = cursorPos;
      }      else {
        myField.value += tag;
        myField.focus();
      }
    }
</script>

<a href="javascript:grin('/疑问')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_question.gif" title="疑问" alt="疑问" /></a>
<a href="javascript:grin('/调皮')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_razz.gif" title="调皮" alt="调皮" /></a>
<a href="javascript:grin('/伤心')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_sad.gif" title="伤心" alt="伤心" /></a>
<a href="javascript:grin('/抠鼻')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_evil.gif" title="抠鼻" alt="抠鼻" /></a>
<a href="javascript:grin('/吓')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_exclaim.gif" title="吓" alt="吓" /></a>
<a href="javascript:grin('/微笑')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_smile.gif" title="微笑" alt="微笑" /></a>
<a href="javascript:grin('/可爱')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_redface.gif" title="可爱" alt="可爱" /></a>
<a href="javascript:grin('/坏笑')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_biggrin.gif" title="坏笑" alt="坏笑" /></a>
<a href="javascript:grin('/惊讶')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_surprised.gif" title="惊讶" alt="惊讶" /></a>
<a href="javascript:grin('/发呆')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_eek.gif" title="发呆" alt="发呆" /></a>
<a href="javascript:grin('/撇嘴')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_confused.gif" title="撇嘴" alt="撇嘴" /></a>
<a href="javascript:grin('/酷')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cool.gif" title="酷" alt="酷" /></a>
<a href="javascript:grin('/赞')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_good.gif" title="赞" alt="赞" /></a>
<a href="javascript:grin('/咒骂')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mad.gif" title="咒骂" alt="咒骂" /></a>
<a href="javascript:grin('/发怒')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_twisted.gif" title="发怒" alt="发怒" /></a>
<a href="javascript:grin('/白眼')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_rolleyes.gif" title="白眼" alt="白眼" /></a>
<a href="javascript:grin('/鼓掌')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_wink.gif" title="鼓掌" alt="鼓掌" /></a>
<a href="javascript:grin('/得意')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_idea.gif" title="得意" alt="得意" /></a>
<a href="javascript:grin('/擦汗')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_arrow.gif" title="擦汗" alt="擦汗" /></a>
<a href="javascript:grin('/哈欠')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_neutral.gif" title="哈欠" alt="哈欠" /></a>
<a href="javascript:grin('/大哭')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_cry.gif" title="大哭" alt="大哭" /></a>
<a href="javascript:grin('/龇牙')"><img src="<?php bloginfo('template_url'); ?>/images/smilies/icon_mrgreen.gif" title="龇牙" alt="龇牙" /></a>
<br />
