function scrollObject(main, width, height, direct, pause, speed) {
    var self = this;
    this.main = main;
    this.width = width;
    this.height = height;
    this.direct = direct;
    this.pause = pause;
    this.speed = Math.max(1.001, Math.min((direct == "up" || direct == "down") ? height : width, speed));
    this.block = new Array();
    this.blockprev = this.offset = 0;
    this.blockcurr = 1;
    this.mouse = false;
    this.scroll = function () {
        if (!document.getElementById)
            return false;
        this.main = document.getElementById(this.main);
        while (this.main.firstChild)
            this.main.removeChild(this.main.firstChild);
        this.main.style.overflow = "hidden";
        this.main.style.position = "relative";
        this.main.style.width = this.width + "px";
        this.main.style.height = this.height + "px";
        for (var x = 0; x < this.block.length; x++) {
            var table = document.createElement('table');
            table.cellPadding = table.cellSpacing = table.border = "0";
            table.style.position = "absolute";
            table.style.left = table.style.top = "0px";
            table.style.width = this.width + "px";
            table.style.height = this.height + "px";
            table.style.overflow = table.style.visibility = "hidden";
            var tbody = document.createElement('tbody');
            var tr = document.createElement('tr');
            var td = document.createElement('td');
            td.innerHTML = this.block[x];
            tr.appendChild(td);
            tbody.appendChild(tr);
            table.appendChild(tbody);
            this.main.appendChild(this.block[x] = table);
        }
        if (this.block.length > 1) {
            this.main.onmouseover = function () {
                self.mouse = true;
            }
            this.main.onmouseout = function () {
                self.mouse = false;
            }
            setInterval(function () {
                if (!self.offset && self.scrollLoop())
                    self.block[self.blockcurr].style.visibility = "visible";
            }, this.pause);
        }
        //this.block[this.blockprev].style.visibility = "visible";
    }
    this.scrollLoop = function () {
        if (!this.offset) {
            if (this.mouse)
                return false;
            this.offset = (this.direct == "up" || this.direct == "down") ? this.height : this.width;
        } else
            this.offset = Math.floor(this.offset / this.speed);
        if (this.direct == "up" || this.direct == "down") {
            this.block[this.blockcurr].style.top = ((this.direct == "up") ? this.offset : -this.offset) + "px";
            this.block[this.blockprev].style.top = ((this.direct == "up") ? this.offset - this.height : this.height - this.offset) + "px";
        } else {
            this.block[this.blockcurr].style.left = ((this.direct == "left") ? this.offset : -this.offset) + "px";
            this.block[this.blockprev].style.left = ((this.direct == "left") ? this.offset - this.width : this.width - this.offset) + "px";
        }
        if (!this.offset) {
            this.block[this.blockprev].style.visibility = "hidden";
            this.blockprev = this.blockcurr;
            if (++this.blockcurr >= this.block.length)
                this.blockcurr = 0;
        } else
            setTimeout(function () {
                self.scrollLoop();
            }, 30);
        return true;
    }
}

function ShowReportDetail(order_id) {
    if($("#OD_"+order_id).css("display")=='none') {
        if($("#OD_"+order_id).html() != "") {
            $("#OD_"+order_id).css("display","");
            $("#line_"+order_id).css("backgroundColor", "#F3F3F3");
        }else{
            $("#OD_"+order_id).html("載入中，請稍候！");
            $.get("sport_order_list_detail.php", { order_id: order_id },
                function(data){
                    $("#OD_"+order_id).css("display","");
                    $("#line_"+order_id).css("backgroundColor", "#F3F3F3");
                    $("#OD_"+order_id).html(data);
                });
        }
    }
    else {
        $("#OD_"+order_id).css("display", "none");
        $("#line_"+order_id).css("backgroundColor", "#FFFFFF");
    }
}