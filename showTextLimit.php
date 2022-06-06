<script>
    let limitChar = (element) => {
        const maxChar = 2000;

        let ele = document.getElementById(element.id);
        let charLen = ele.value.length;
        
        let p = document.getElementById('charCounter');
        
        p.innerHTML = (maxChar - charLen) + ` caractère(s) restant(s).` || null;
        
        if (charLen <= 1800) 
        {
            ele.value = ele.value.substring(0, maxChar);
            p.innerHTML = ''; 
        }
    }
</script>